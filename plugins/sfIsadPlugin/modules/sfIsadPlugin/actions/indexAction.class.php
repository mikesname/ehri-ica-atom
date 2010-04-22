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

/**
 * Information Object - showIsad
 *
 * @package    qubit
 * @subpackage informationObject - initialize a showIsad template for displaying an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class sfIsadPluginIndexAction extends InformationObjectIndexAction
{
  public function execute($request)
  {
    parent::execute($request);

    if (1 > strlen($title = QubitIsad::getLabel($this->object)))
    {
      $title = $this->context->i18n->__('Untitled');
    }
    $this->response->setTitle($title.' - '.$this->response->getTitle());

    // Function relations
    $criteria = new Criteria;
    $criteria->addAlias('so', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitRelation::SUBJECT_ID, 'so.id', Criteria::INNER_JOIN);
    $criteria->add(QubitRelation::OBJECT_ID, $this->object->id);
    $criteria->add('so.class_name', 'QubitFunction');

    $this->functionRelations = QubitRelation::get($criteria);

    if (QubitAcl::check($this->object, 'update'))
    {
      $validatorSchema = new sfValidatorSchema;
      $validatorSchema->creators = new QubitValidatorCountable(array('required' => true), array('required' => $this->context->i18n->__('This archival description, or one of its higher levels, %1%requires%2% at least one %3%creator%4%.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#I.12">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#3.2.1">', '%4%' => '</a>'))));
      $validatorSchema->dateRange = new QubitValidatorIsadDates(array(), array('invalid' => $this->context->i18n->__('%1%Date(s)%2% - are not consistent with %3%higher levels%2%.', array('%1%' => '<a href="http://www.ica-atom.org/docs/index.php?title=RS-1#3.1.3">', '%2%' => '</a>', '%3%' => '<a href="%ancestor%">'))));
      $validatorSchema->dates = new QubitValidatorCountable(array('required' => true), array('required' => $this->context->i18n->__('%1%Date(s)%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#3.1.3">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#I.12">', '%4%' => '</a>'))));
      $validatorSchema->extentAndMedium = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Extent and medium%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#3.1.5">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#I.12">', '%4%' => '</a>'))));
      $validatorSchema->identifier = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Identifier%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#3.1.1">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#I.12">', '%4%' => '</a>'))));
      $validatorSchema->levelOfDescription = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Level of description%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#3.1.4">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#I.12">', '%4%' => '</a>'))));
      $validatorSchema->title = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Title%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#3.1.2">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#I.12">', '%4%' => '</a>'))));

      // Forbidden values for this level of description (based on the parent level of description)
      $forbiddenValues = array();

      // Greater levels first
      $levels = array('Collection', 'Fonds', 'Subfonds', 'Sub-subfonds', 'Series', 'Subseries', 'Sub-subseries', 'File', 'Item');

      // Check that object has a parent level of description, i.e. a parent which is not the root
      if (null !== $this->object->parent->levelOfDescription && null !== $this->object->levelOfDescription)
      {
        $parentLevelOfDescription = $this->object->getParent()->getLevelOfDescription()->getName(array('sourceCulture' => 'en'));

        // We validate that an ancestor level is not added as a descendant
        for ($i = 0; $i <= array_search($parentLevelOfDescription, $levels); $i++)
        {
          $forbiddenValues[] = $levels[$i];
        }

        // Special cases
        switch ($parentLevelOfDescription)
        {
          // Fonds cannot be child of Collection
          // Sub-fonds cannot be child of Collection
          case 'Collection':
            $forbiddenValues[] = 'Fonds';
            $forbiddenValues[] = 'Subfonds';
            break;
          // Collection cannot be child of Fonds
          case 'Fonds':
            $forbiddenValues[] = 'Collection';
            break;
        }
      }

      if (0 == count($creators = $this->object->getCreators()))
      {
        foreach ($this->object->getAncestors() as $ancestor)
        {
          if (0 < count($creators = $ancestor->getCreators()))
          {
            // We don't need creators, just to know that we have at least one
            break;
          }
        }
      }

      $validatorSchema->levelOfDescription = new sfValidatorBlacklist(array('forbidden_values' => $forbiddenValues, 'required' => true), array('forbidden' => $this->context->i18n->__('%1%Level of description%2% - Value "%value%" is not consistent with higher levels.', array('%1%' => '<a href="http://www.ica-atom.org/docs/index.php?title=RS-1#3.1.4">', '%2%' => '</a>')), 'required' => $this->context->i18n->__('%1%Level of description%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#3.1.4">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-1#I.12">', '%4%' => '</a>'))));

      try
      {
        $validatorSchema->clean(array(
          'identifier' => $this->object->identifier,
          'title' => $this->object->getTitle(array('cultureFallback' => true)),
          'dates' => $this->object->getDates(),
          'dateRange' => $this->object,
          'levelOfDescription' => null !== $this->object->levelOfDescription ? $this->object->levelOfDescription->getName(array('culture' => 'en')) : null,
          'extentAndMedium' => $this->object->getExtentAndMedium(array('cultureFallback' => true)),
          'creators' => $creators));
      }
      catch (sfValidatorErrorSchema $e)
      {
        $this->errorSchema = $e;
      }
    }

    // Split notes into "Notes" (general notes), "Title notes", and "Publication notes"
    $this->notes = $this->object->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID));
    $this->archivistsNotes = $this->object->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID));
    $this->publicationNotes = $this->object->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
  }
}
