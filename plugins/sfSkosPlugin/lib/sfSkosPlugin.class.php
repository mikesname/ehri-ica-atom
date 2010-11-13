<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

class sfSkosPlugin
{
  protected
    $terms = array();

  public static function parse($doc, $options = array())
  {
    $terms = array();

    libxml_use_internal_errors(true);

    // Report XML errors
    if (!$doc)
    {
      foreach (libxml_get_errors() as $error)
      {
        //TODO echo errors in template. Use custom validator?
        var_dump($error);
      }
    }

    $skos = new sfSkosPlugin;
    $skos->xpath = new DOMXPath($doc);

    // Create Xpath object, register namespaces
    $skos->xpath->registerNamespace('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    $skos->xpath->registerNamespace('skos', 'http://www.w3.org/2004/02/skos/core#');
    $skos->xpath->registerNamespace('dc', 'http://purl.org/dc/elements/1.1/');

    // Set taxonomy
    $skos->taxonomy = QubitTaxonomy::getById(QubitTaxonomy::SUBJECT_ID);
    if (isset($options['taxonomy']))
    {
      $skos->taxonomy = $options['taxonomy'];
    }

    $skos->parent = QubitTerm::getById(QubitTerm::ROOT_ID);
    if (isset($options['parent']))
    {
      $skos->parent = $options['parent'];
    }

    // Select all top-level concepts (no 'broader' child-nodes)
    foreach ($skos->xpath->query('skos:Concept[not(skos:broader)]') as $concept)
    {
      if (!($concept instanceof domElement))
      {
        continue;
      }

      $skos->addTerm($concept, null);
    }

    $skos->addTermAssociations();

    return $skos->terms;
  }

  protected function addTerm($concept, $parent)
  {
    $term = new QubitTerm;
    $term->taxonomy = $this->taxonomy;

    // Set parent
    if (isset($parent))
    {
      $term->parentId = $parent->id;
    }
    else
    {
      $term->parent = $this->parent;
    }

    // Preferred label
    $prefLabels = $this->xpath->query('./skos:prefLabel', $concept);

    foreach ($prefLabels as $prefLabel)
    {
      $value = self::setI18nValue($term, $prefLabel);

      if (isset($value))
      {
        $validName = $value;
      }
    }

    // Don't save a term with no valid name
    if (!isset($validName))
    {
      return;
    }

    // Alternate labels
    foreach ($this->xpath->query('./skos:altLabel', $concept) as $altLabel)
    {
      $otherName = new QubitOtherName;
      $otherName->typeId = QubitTerm::ALTERNATIVE_LABEL_ID;

      $value = self::setI18nValue($otherName, $altLabel);

      if (isset($value))
      {
        $term->otherNames[] = $otherName;
      }
    }

    // URI - save as source note
    $uri = $concept->getAttributeNodeNS('http://www.w3.org/1999/02/22-rdf-syntax-ns#', 'about');
    if ($uri instanceof DOMAttr)
    {
      $note = new QubitNote;
      $note->typeId = QubitTerm::SOURCE_NOTE_ID;
      $note->content = $uri->nodeValue;

      $term->notes[] = $note;
    }

    // Scope notes
    foreach ($this->xpath->query('./skos:scopeNote', $concept) as $scopeNote)
    {
      $note = new QubitNote;
      $note->typeId = QubitTerm::SCOPE_NOTE_ID;

      $value = self::setI18nValue($note, $scopeNote);

      if (isset($value))
      {
        $term->notes[] = $note;
      }
    }

    // Save the term
    $term->save();
    $this->terms[] = $term;

    // Find and add narrow terms
    // TODO: Merge broader/narrower relations for this term, as defining
    // inverse of relationship is not required by SKOS
    // http://www.w3.org/TR/2009/NOTE-skos-primer-20090818/#sechierarchy
    if ($uri instanceof DOMAttr)
    {
      foreach ($this->xpath->query('./skos:Concept[skos:broader[@rdf:resource="'.$uri->nodeValue.'"]]') as $narrower)
      {
        if (!($narrower instanceof DOMElement))
        {
          continue;
        }

        $this->addTerm($narrower, $term);
      }
    }

    return $this;
  }

  protected function addTermAssociations()
  {
    $count = 0;
    $relations = array();

    foreach ($this->xpath->query('skos:Concept[skos:related]') as $concept)
    {
      $subjectUri = $concept->getAttributeNodeNS('http://www.w3.org/1999/02/22-rdf-syntax-ns#', 'about');
      if (!($subjectUri instanceof DOMAttr) || null === $subject = self::getTermBySourceNote($subjectUri->nodeValue))
      {
        continue;
      }

      foreach ($this->xpath->query('./skos:related', $concept) as $related)
      {
        $objectUri = $related->getAttributeNodeNS('http://www.w3.org/1999/02/22-rdf-syntax-ns#', 'resource');
        if (!($objectUri instanceof DomAttr) || null === $obj = self::getTermBySourceNote($objectUri->nodeValue))
        {
          continue;
        }

        // Don't duplicate reciprocal relationship
        foreach ($relations as $r)
        {
          if ($r['subject'] == $objectUri->nodeValue && $r['object'] == $subjectUri->nodeValue)
          {
            continue 2;
          }
        }

        $relation = new QubitRelation;
        $relation->typeId = QubitTerm::TERM_RELATION_ASSOCIATIVE_ID;
        $relation->subject = $subject;
        $relation->object = $obj;

        $relation->save();

        $relations[] = array('subject' => $subjectUri->nodeValue, 'object' => $objectUri->nodeValue);
      }
    }

    return $this;
  }

  protected static function getTermBySourceNote($sourceNote)
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitTerm::ID, QubitNote::OBJECT_ID);
    $criteria->addJoin(QubitNote::ID, QubitNoteI18n::ID);
    $criteria->add(QubitNoteI18n::CONTENT, $sourceNote);

    return QubitTerm::getOne($criteria);
  }

  protected static function setI18nValue($obj, $domNode)
  {
    if (!($domNode instanceof DOMElement))
    {
      return;
    }

    switch (get_class($obj))
    {
      case 'QubitNote':
        $colName = 'content';
        break;

      default:
        $colName = 'name';
    }

    // Check for xml:lang attribute
    if (null !== $langNode = $domNode->attributes->getNamedItem('lang'))
    {
      $message = $domNode->nodeValue;
      $culture = $langNode->nodeValue;
    }

    else
    {
      $message = $domNode->nodeValue;
    }

    $obj->__set($colName, $message, array('culture' => $culture));

    if (isset($culture) && !isset($term->sourceCulture))
    {
      $obj->sourceCulture = $culture;
    }

    return $obj->__get($colName, array('culture' => $culture));
  }
}
