<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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
 * Import a CSV file into Qubit.
 *
 * @package    Qubit
 * @subpackage library
 * @author     MJ Suhonos <mj@artefactual.com>
 * @version    svn:$Id: QubitCsvImport.class.php 9112 2011-05-20 01:35:23Z mj $
 */
class QubitCsvImport
{
  protected
    $errors = null,
    $rootObject = null;

  public function import($csvFile, $options = array())
  {
    // load the CSV document into an array
    $data = $this->loadCSV($csvFile);

    // information object schema element names
    $names['rad'] = array_flip(array_map(array('sfInflector', 'underscore'), sfRadPluginEditAction::$NAMES));
    $names['isad'] = array_flip(array_map(array('sfInflector', 'underscore'), sfIsadPluginEditAction::$NAMES));

    // repository schema element names
    $names['isdiah'] = array_flip(array_map(array('sfInflector', 'underscore'), sfIsdiahPluginEditAction::$NAMES));
    $names['isdiah'] = array_merge($names['isdiah'], array_flip(array_map(array('sfInflector', 'underscore'), ContactInformationEditComponent::$NAMES)));

    // determine what kind of schema we're trying to import
    $header = array_flip($data['header']);
    unset($data['header']);

    // see if any of these schemas match close enough
    if (!in_array($options['schema'], array('rad', 'isad', 'isdiah')))
    {
      foreach ($names as $name => $elements)
      {
        $match = array_intersect_key($elements, $header);

        $scores[$name] = count($match)/count($header);
      }

      arsort($scores);

      // schema must match at least 50% of elements
      if (current($scores) > 0.5)
      {
        $importSchema = key($scores);
      }
    }
    else
    {
      $importSchema = $options['schema'];
    }

    if (!isset($importSchema))
    {
      $errorMsg = sfContext::getInstance()->i18n->__('Unable to import CSV file: cannot determine schema type');

      throw new Exception($errorMsg);
    }

    // switch context and create a new object using the import schema
    $this->context = sfContext::getInstance();

    switch ($importSchema)
    {
      case 'isdiah':
        $action = new sfIsdiahPluginEditAction($this->context, 'sfIsdiahPlugin', 'edit');
        break;
      case 'rad':
        $action = new sfRadPluginEditAction($this->context, 'sfRadPlugin', 'edit');
        break;
      case 'isad':
        $action = new sfIsadPluginEditAction($this->context, 'sfRadPlugin', 'edit');
        break;
    }

    // we are not editing an existing object
    unset($action->getRoute()->resource);

    // populate parameter holder with properties for the object
    foreach ($data as $index => $row)
    {
      $parameters = array_combine(array_map('lcfirst', array_map(array('sfInflector', 'camelize'), array_keys($header))), $row);

      // generic mapping for hierarchical data
      if (isset($parameters['id']))
      {
        $ids[$index] = $parameters['id'];
      }

      if (isset($parameters['parent']))
      {
        $parents[$index] = $parameters['parent'];
      }

      // special cases for various schemas to map to parameter holders
      switch ($importSchema)
      {
        case 'isdiah':
          $parameters = $this->mapIsdiah($parameters);
          break;
        case 'rad':
          $parameters = $this->mapInformationObject($parameters);
          $parameters = $this->mapRad($parameters);
          break;
        case 'isad':
          $parameters = $this->mapInformationObject($parameters);
          $parameters = $this->mapIsad($parameters);
          break;
      }

      $parameterArray[] = $this->mapEdit($parameters);
    }

    // if we have hierarchy information, re-order data rows
    if (isset($ids) && isset($parents))
    {
      array_multisort($parents, SORT_ASC, $ids, SORT_ASC, $parameterArray);
    }

    // emulate a POST form submission with given data
    $request = $this->context->getRequest();
    $request->setParameter('csvimport', true);

    // populate and submit the form for each data row
    $insertIds = array();
    foreach ($parameterArray as $index => $parameters)
    {
      if (!empty($parameters['parent']))
      {
        $parameters['parent'] = $insertIds[$parameters['parent']];
      }

      // run the action to create and save the new object
      $request->getParameterHolder()->add($parameters);
      $action->execute($request);

      // keep track of the insert ID for parenting
      $insertIds[$parameters['id']] = $action->resource->id;

      // set the rootObject to use for initial display in successful import
      if (!$this->rootObject)
      {
        $this->rootObject = $action->resource;
      }
    }

    return $this;
  }

  protected function loadCSV($csvFile)
  {
    // make sure we get the right EOL character
    ini_set('auto_detect_line_endings', true);
    $fh = fopen($csvFile, 'rb');

    // Get header (first) row
    foreach (fgetcsv($fh) as $col => $label)
    {
        // normalize the column labels to match defined fields
        $header[$col] = preg_replace(array('/(\s|\/)+/', '/[^a-z_]/', '/_$/'), array('_', ''), strtolower(sfInflector::underscore($label)));
    }
    $data['header'] = $header;

    // the rest of data is n-indexed
    while ($row = fgetcsv($fh))
    {
        $data[] = $row;
    }

    fclose($fh);

    return $data;
  }

  protected function mapEdit($parameters)
  {
    // convert pipe-delimited values into multi-value
    $n = 0;
    foreach (explode('|', $parameters['parallelName']) as $new_parallelName)
    {
      $new_parallelNames['new'.$n] = $new_parallelName;
      $n++;
    }
    $parameters['parallelName'] = $new_parallelNames;

    $n = 0;
    foreach (explode('|', $parameters['otherName']) as $new_otherName)
    {
      $new_otherNames['new'.$n] = $new_otherName;
      $n++;
    }
    $parameters['otherName'] = $new_otherNames;

    // check constrained values are valid
    if (!isset($this->culture))
    {
      $culture = $this->context->user->getCulture();
      $this->culture = sfCultureInfo::getInstance($culture);
    }

    // NB: this only matches ISO-639-2 codes, eg. "en"
    if (!in_array($parameters['language'], array_keys($this->culture->getLanguages())))
    {
      unset($parameters['language']);
    }

    if (!in_array($parameters['languageOfDescription'], array_keys($this->culture->getLanguages())))
    {
      unset($parameters['languageOfDescription']);
    }

    // NB: this only matches Symfony script codes, eg. "Latn"
    if (!in_array($parameters['script'], array_keys($this->culture->getScripts())))
    {
      unset($parameters['script']);
    }

    if (!in_array($parameters['scriptOfDescription'], array_keys($this->culture->getScripts())))
    {
      unset($parameters['scriptOfDescription']);
    }

    if (!isset($this->levelsOfDescription))
    {
      foreach (QubitTerm::getLevelsOfDescription() as $term)
      {
        $this->levelsOfDescription[] = $term;
      }
    }

    if (!in_array($parameters['levelOfDescription'], $this->levelsOfDescription))
    {
      unset($parameters['levelOfDescription']);
    }

    if (!isset($this->descriptionDetailLevels))
    {
      foreach (QubitTerm::getDescriptionDetailLevels() as $term)
      {
        $this->descriptionDetailLevels[] = $term;
      }
    }

    if (!in_array($parameters['descriptionDetail'], $this->descriptionDetailLevels))
    {
      unset($parameters['descriptionDetail']);
    }

    if (!isset($this->descriptionStatuss))
    {
      foreach (QubitTerm::getDescriptionStatuses() as $term)
      {
        $this->descriptionStatuss[] = $term;
      }
    }

    if (!in_array($parameters['descriptionStatus'], $this->descriptionStatuss))
    {
      unset($parameters['descriptionStatus']);
    }

    return $parameters;
  }

  protected function mapInformationObject($parameters)
  {
    // NB: any value for publication status means set to published
    if (!empty($parameters['publicationStatus']))
    {
      $parameters['publicationStatus'] = QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID;
    }

    if (!empty($parameters['repository']))
    {
      $repo = QubitRepository::getByAuthorizedFormOfName($parameters['repository']);

      // if the repository does not exist, create it
      if (empty($repo))
      {
        $repo = new QubitRepository();
        $repo->authorizedFormOfName = $parameters['repository'];
        $repo->save();
      }
      $parameters['repository'] = $this->context->routing->generate(null, array($repo, 'module' => 'repository'));
    }

    // subject access points
    if (!isset($this->subjects))
    {
      foreach (QubitTerm::getSubjects() as $term)
      {
        $this->subjects[$term->__toString()] = $term;
      }
    }

    $n = 0;
    foreach (explode('|', $parameters['subjectAccessPoints']) as $new_subjectAccessPoint)
    {
      // if the subject does not exist, create it
      if (!in_array($new_subjectAccessPoint, $this->subjects) && !empty($new_subjectAccessPoint))
      {
        $subject = new QubitTerm();
        $subject->taxonomyId = QubitTaxonomy::SUBJECT_ID;
        $subject->name = $new_subjectAccessPoint;
        $subject->save();

        $this->subjects[$subject->__toString()] = $subject;
      }

      $new_subjectAccessPoints['new'.$n] = $this->context->routing->generate(null, array($this->subjects[$new_subjectAccessPoint], 'module' => 'term'));
      $n++;
    }
    $parameters['subjectAccessPoints'] = $new_subjectAccessPoints;

    // place access points
    if (!isset($this->places))
    {
      foreach (QubitTerm::getPlaces() as $term)
      {
        $this->places[$term->__toString()] = $term;
      }
    }

    $n = 0;
    foreach (explode('|', $parameters['placeAccessPoints']) as $new_placeAccessPoint)
    {
      // if the place does not exist, create it
      if (!in_array($new_placeAccessPoint, $this->places) && !empty($new_placeAccessPoint))
      {
        $place = new QubitTerm();
        $place->taxonomyId = QubitTaxonomy::PLACE_ID;
        $place->name = $new_placeAccessPoint;
        $place->save();

        $this->places[$place->__toString()] = $place;
      }

      $new_placeAccessPoints['new'.$n] = $this->context->routing->generate(null, array($this->places[$new_placeAccessPoint], 'module' => 'term'));
      $n++;
    }
    $parameters['placeAccessPoints'] = $new_placeAccessPoints;

    // name access points
    if (!isset($this->names))
    {
      foreach (QubitActor::getOnlyActors() as $name)
      {
        $this->names[$name->__toString()] = $name;
      }
    }

    $n = 0;
    foreach (explode('|', $parameters['nameAccessPoints']) as $new_nameAccessPoint)
    {
      // if the name does not exist, create it
      if (!in_array($new_nameAccessPoint, $this->names) && !empty($new_nameAccessPoint))
      {
        $name = new QubitActor();
        $name->authorizedFormOfName = $new_nameAccessPoint;
        $name->save();

        $this->names[$name->__toString()] = $name;
      }

      $new_nameAccessPoints['new'.$n] = $this->context->routing->generate(null, array($this->names[$new_nameAccessPoint], 'module' => 'actor'));
      $n++;
    }
    $parameters['nameAccessPoints'] = $new_nameAccessPoints;

    return $parameters;
  }

  protected function mapRad($parameters)
  {
    if (!isset($this->materialTypes))
    {
      foreach (QubitTerm::getMaterialTypes() as $term)
      {
        $this->materialTypes[$term->__toString()] = $this->context->routing->generate(null, array($term, 'module' => 'term'));
      }
    }

    $n = 0;
    foreach (explode('|', $parameters['type']) as $new_type)
    {
      if (in_array($new_type, array_keys($this->materialTypes)))
      {
        $new_types['new'.$n] = $this->materialTypes[$new_type];
        $n++;
      }
    }
    $parameters['type'] = $new_types;

    if (!isset($this->radTitleNotes))
    {
      foreach (QubitTerm::getRADTitleNotes() as $term)
      {
        $this->radTitleNotes[$term->id] = $term;
      }
    }

    if (!in_array($parameters['radTitleNoteType'], $this->radTitleNotes))
    {
      unset($parameters['radTitleNote']);
      unset($parameters['radTitleNoteType']);
    }
    else
    {
      $parameters['radTitleNoteType'] = array_search($parameters['radTitleNoteType'], $this->radTitleNotes);
    }

    if (!isset($this->radNotes))
    {
      foreach (QubitTerm::getRADNotes() as $term)
      {
        $this->radNotes[$term->id] = $term;
      }
    }

    if (!in_array($parameters['radNoteType'], $this->radNotes))
    {
      unset($parameters['radNote']);
      unset($parameters['radNoteType']);
    }
    else
    {
      $parameters['radNoteType'] = array_search($parameters['radNoteType'], $this->radNotes);
    }

    return $parameters;
  }

  protected function mapIsad($parameters)
  {
    // dates of creation
    $creationTerm = new QubitTerm();
    $creationTerm->id = QubitTerm::CREATION_ID;
    $termType = $this->context->routing->generate(null, array($creationTerm, 'module' => 'term'));

    $n = 0;
    foreach (explode('|', $parameters['datesOfCreation']) as $new_date)
    {
      // TODO: validate date/range format somehow
      if (!empty($new_date))
      {
        $new_dates['new'.$n] = array('type' => $termType, 'date' => $new_date);
        $n++;
      }
    }
    $parameters['datesOfCreation'] = $new_dates;

    // name access points
    if (!isset($this->names))
    {
      foreach (QubitActor::getOnlyActors() as $name)
      {
        $this->names[$name->__toString()] = $name;
      }
    }

    $n = 0;
    foreach (explode('|', $parameters['creators']) as $new_creator)
    {
      // if the name does not exist, create it
      if (!in_array($new_creator, $this->names) && !empty($new_creator))
      {
        $name = new QubitActor();
        $name->authorizedFormOfName = $new_creator;
        $name->save();

        $this->names[$name->__toString()] = $name;
      }

      $new_creators['new'.$n] = $this->context->routing->generate(null, array($this->names[$new_creator], 'module' => 'actor'));
      $n++;
    }
    $parameters['creators'] = $new_creators;

    // convert pipe-delimited values into multi-value
    $n = 0;
    foreach (explode('|', $parameters['newArchivistNote']) as $new_archivistNote)
    {
      $new_archivistNotes['new'.$n] = $new_archivistNote;
      $n++;
    }
    $parameters['newArchivistNote'] = $new_archivistNotes;

    $n = 0;
    foreach (explode('|', $parameters['newPublicationNote']) as $new_publicationNote)
    {
      $new_publicationNotes['new'.$n] = $new_publicationNote;
      $n++;
    }
    $parameters['newPublicationNote'] = $new_publicationNotes;

    $n = 0;
    foreach (explode('|', $parameters['newNote']) as $new_Note)
    {
      $new_Notes['new'.$n] = $new_Note;
      $n++;
    }
    $parameters['newNote'] = $new_Notes;

    return $parameters;
  }

  protected function mapIsdiah($parameters)
  {
    // remove duplicate values
    if ($parameters['parallelName'] == $parameters['authorizedFormOfName'])
    {
      unset($parameters['parallelName']);
    }

    if ($parameters['otherName'] == $parameters['authorizedFormOfName'])
    {
      unset($parameters['otherName']);
    }

    // NB: this is hacky, but required for an inconsistency in repository property names
    if (!isset($this->descriptionDetailLevels))
    {
      foreach (QubitTerm::getDescriptionDetailLevels() as $term)
      {
        $this->descriptionDetailLevels[] = $term;
      }
    }

    if (!in_array($parameters['descDetail'], $this->descriptionDetailLevels))
    {
      unset($parameters['descDetail']);
    }

    if (!isset($this->descriptionStatuss))
    {
      foreach (QubitTerm::getDescriptionStatuses() as $term)
      {
        $this->descriptionStatuss[] = $term;
      }
    }

    if (!in_array($parameters['descStatus'], $this->descriptionStatuss))
    {
      unset($parameters['descStatus']);
    }

    return $parameters;
  }

  /**
   * Return true if import had errors
   *
   * @return boolean
   */
  public function hasErrors()
  {
    return $this->errors != null;
  }

  /**
   * Return array of error messages
   *
   * @return unknown
   */
  public function getErrors()
  {
    return $this->errors;
  }

  /**
   * Get the root object for the import
   *
   * @return mixed the root object (object type depends on import type)
   */
  public function getRootObject()
  {
    return $this->rootObject;
  }

}