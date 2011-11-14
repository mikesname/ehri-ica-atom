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

class QubitSearch extends xfIndexSingle
{

  // allow disabling search index via boolean flag
  public $disabled = false;

  /*
   * Enable singleton creation via getInstance()
   */
  protected static $_instance;

  public static function getInstance()
  {
    if (null === self::$_instance)
    {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  public function parse($query)
  {
    $query = Zend_Search_Lucene_Search_QueryParser::parse($query, 'UTF-8');

    if ($query instanceOf Zend_Search_Lucene_Search_Query_Insignificant) {
        throw new Exception('No search terms specified.');
    } elseif ($query instanceOf Zend_Search_Lucene_Search_Query_MultiTerm) {
        throw new Exception('Error parsing search terms.');
    }

    return $query;
  }

  public function addTerm($text, $field)
  {
    return new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($text, $field));
  }

  /**
   * @see xfIndex
   */
  protected function initialize()
  {
    $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir').'/index'));
    $this->getEngine()->open();
    Zend_Search_Lucene_Search_QueryParser::setDefaultOperator(Zend_Search_Lucene_Search_QueryParser::B_AND);
  }

  /**
   * @see xfIndex
   */
  public function qubitPopulate($options)
  {
    $conn = Propel::getConnection();

    $start = microtime(true);
    $this->getLogger()->log('Populating index...', $this->getName());

    // if we are using an offset to resume from a segfault, optimize the index instead of deleting
    if (!isset($options['actorOffset']) && !isset($options['ioOffset']))
    {
      $this->getEngine()->erase();
      $this->getLogger()->log('Index erased.', $this->getName());
    }
    else
    {
      $this->optimize();
    }

    // set buffering and updates to be batched for better performance
    // NB: not sure why this doesn't work in object scope
    self::getInstance()->getEngine()->enableBatchMode();

    $actorOffset = intval($options['actorOffset']);
    $ioOffset = intval($options['ioOffset']);

    // index actors
    if (-1 < $actorOffset)
    {
      // Get count of all actors
      $sql = 'SELECT COUNT(*) from '.QubitActor::TABLE_NAME;
      $rs = $conn->query($sql);
      $rowcount = $rs->fetchColumn(0);

      // Get actors (with offset)
      $criteria = new Criteria;
      QubitActor::addSelectColumns($criteria);

      if (0 < $actorOffset)
      {
        $criteria->setOffset($actorOffset);
      }

      $actors = QubitActor::get($criteria);

      // Loop through results, and add to search index
      foreach ($actors as $key => $actor)
      {
        if ($key == 0 && 0 < $actorOffset)
        {
          $this->getLogger()->log('Ignoring first '.$actorOffset.' actors.');
        }

        self::addActorIndex($actor);

        $this->getLogger()->log('"'.$actor->__toString().'" inserted ('.round(microtime(true) - $start, 2).'s) ('.($key + $actorOffset + 1).'/'.$rowcount.')', $this->getName());
      }
    }
    else
    {
      $this->getLogger()->log('Actors are ignored.');
    }

    // index information objects
    if (-1 < $ioOffset)
    {
      // Get count of all information objects
      $sql = 'SELECT COUNT(*) from '.QubitInformationObject::TABLE_NAME;
      $rs = $conn->query($sql);
      $rowcount = $rs->fetchColumn(0);

      // Get info objects (with offset)
      $criteria = new Criteria;
      QubitInformationObject::addSelectColumns($criteria);

      if (0 < $ioOffset)
      {
        $criteria->setOffset($ioOffset);
      }

      $informationObjects = QubitInformationObject::get($criteria);

      // Loop through results, and add to search index
      foreach ($informationObjects as $key => $informationObject)
      {
        if ($key == 0 && 0 < $ioOffset)
        {
          $this->getLogger()->log('Ignoring first '.$ioOffset.' information objects.');
        }

        if (0 < count($languages = $this->getTranslatedLanguages($informationObject)))
        {
          foreach ($languages as $language)
          {
            self::addInformationObjectIndex($informationObject, $language, $options);
          }
        }

        $this->getLogger()->log('"'.$informationObject->__toString().'" inserted ('.round(microtime(true) - $start, 2).'s) ('.($key + $ioOffset + 1).'/'.$rowcount.')', $this->getName());
      }
    }
    else
    {
      $this->getLogger()->log('Information objects are ignored.');
    }

    $this->getLogger()->log('Index populated in "'.round(microtime(true) - $start, 2).'" seconds.', $this->getName());
  }

  public function optimize()
  {
    $start = microtime(true);
    $this->getLogger()->log('Optimizing index...', $this->getName());
    $this->getEngine()->optimize();
    $this->getLogger()->log('Index optimized in "' . round(microtime(true) - $start, 2) . '" seconds.', $this->getName());
  }

  /*
   * ======================================================================
   * In lieu of a service registry (the "right" way to implement these methods)
   * we have engine-specific handling below here; these are based on Zend Lucene
   * ======================================================================
   */

  /**
   * Delete an existing document from the index
   *
   * @param integer $id object identifier
   * @return void
   */
  public static function deleteById($id)
  {
    // have to use another search object to perform the querying
    $querier = new QubitSearch();
    $query = new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($id, 'id'));

    foreach ($querier->getEngine()->getIndex()->find($query) as $hit)
    {
      self::getInstance()->getEngine()->getIndex()->delete($hit->id);
    }
  }

  /**
   * Delete an existing document from the index
   *
   * @param integer $id object identifier
   * @param string $language ISO-639-1 code
   * @return void
   */
  public static function deleteByIdLanguage($id, $language)
  {
    // have to use another search object to perform the querying
    $querier = new QubitSearch();
    $query = new Zend_Search_Lucene_Search_Query_MultiTerm;
    $query->addTerm(new Zend_Search_Lucene_Index_Term($id, 'id'), true);
    $query->addTerm(new Zend_Search_Lucene_Index_Term($language, 'culture'), true);

    foreach ($querier->getEngine()->getIndex()->find($query) as $hit)
    {
      self::getInstance()->getEngine()->getIndex()->delete($hit->id);
    }
  }

  /**
   * Get list of currently enabled languages from config
   *
   * @return array enabled language codes and names
   */
  public static function getEnabledI18nLanguages()
  {
    //determine the currently enabled i18n languages
    $enabledI18nLanguages = array();

    foreach (sfConfig::getAll() as $setting => $value)
    {
      if (0 === strpos($setting, 'app_i18n_languages'))
      {
        $enabledI18nLanguages[substr($setting, 19)] = $value;
      }
    }

    return $enabledI18nLanguages;
  }

  /**
   * Get translated language codes
   *
   * @return array list of translated languages (ISO-639-1 code)
   */
  public static function getTranslatedLanguages(&$object)
  {
    $conn = Propel::getConnection();

    // If this class has an i18n table
    if (class_exists(get_class($object).'I18n'))
    {
      $i18nTableName = constant(get_class($object).'I18n::TABLE_NAME');

      $stmt = $conn->prepare('SELECT culture FROM '.$i18nTableName.' WHERE id = ? GROUP BY culture');
      $stmt->execute(array($object->id));

      while ($row = $stmt->fetch())
      {
        $translatedLanguages[] = $row['culture'];
      }

      $stmt->closeCursor();
      $conn->clearStatementCache();
    }
    else
    {
      $translatedLanguages = self::getEnabledI18nLanguages();
    }

    return $translatedLanguages;
  }

  /*
   * ======================================================================
   * ACTORS
   * ======================================================================
   */

  public static function updateActorIndex($actor)
  {
    if (self::getInstance()->disabled) return;

    // Don't index root object
    if ($actor::ROOT_ID == $actor->id)
    {
      return;
    }

    self::deleteById($actor->id);
    self::addActorIndex($actor);
  }

  public static function addActorIndex(QubitActor $actor)
  {
    // Don't index root object
    if ($actor::ROOT_ID == $actor->id)
    {
      return;
    }

    foreach ($actor->actorI18ns as $actorI18n)
    {
      $doc = new Zend_Search_Lucene_Document;

      $doc->addField(Zend_Search_Lucene_Field::Keyword('id', $actor->id));
      $doc->addField(Zend_Search_Lucene_Field::Keyword('className', $actor->className));
      $doc->addField(Zend_Search_Lucene_Field::Keyword('culture', $actorI18n->culture));

      if (isset($actorI18n->authorizedFormOfName))
      {
        $doc->addField(Zend_Search_Lucene_Field::UnStored('authorizedFormOfName', $actorI18n->authorizedFormOfName));
      }

      // Add other forms of name for this culture
      $criteria = new Criteria;
      $criteria->addJoin(QubitOtherNameI18n::ID, QubitOtherName::ID);
      $criteria->add(QubitOtherNameI18n::CULTURE, $actorI18n->culture);
      $criteria->add(QubitOtherName::OBJECT_ID, $actor->id);

      if (0 < count($otherNameI18ns = QubitOtherNameI18n::get($criteria)))
      {
        foreach ($otherNameI18ns as $otherNameI18n)
        {
          $otherNames[] = $otherNameI18n->name;
        }

        $doc->addField(Zend_Search_Lucene_Field::UnStored('otherFormsOfName', implode(' ', $otherNames)));
      }

      self::getInstance()->getEngine()->getIndex()->addDocument($doc);
    }
  }

  /*
   * ======================================================================
   * INFORMATION OBJECTS
   * ======================================================================
   */

  public static function deleteInformationObject($informationObject, $options = array())
  {
    if (0 < count($languages = self::getTranslatedLanguages($informationObject)))
    {
      foreach ($languages as $language)
      {
        self::deleteByIdLanguage($informationObject->id, $language);
      }
    }
  }

  public static function updateInformationObject($informationObject, $options = array())
  {
    if (self::getInstance()->disabled) return;

    // Only ROOT node should have no parent, don't index
    if (null === $informationObject->parent)
    {
      return;
    }

    if (0 < count($languages = self::getTranslatedLanguages($informationObject)))
    {
      foreach ($languages as $language)
      {
        self::updateInformationObjectIndex($informationObject, $language, $options);
      }
    }
  }

  public static function updateInformationObjectIndex(QubitInformationObject $informationObject, $language, $options = array())
  {
    if (self::getInstance()->disabled) return;

    // Only ROOT node should have no parent, don't index
    if (null === $informationObject->parent)
    {
      return;
    }

    self::deleteByIdLanguage($informationObject->id, $language);
    self::addInformationObjectIndex($informationObject, $language, $options);
  }

  public static function addInformationObjectIndex(QubitInformationObject $informationObject, $language, $options = array())
  {

    // Only ROOT node should have no parent, don't index
    if (null === $informationObject->parent)
    {
      return;
    }

    $doc = new Zend_Search_Lucene_Document;

    // Reference elements
    $doc->addField(Zend_Search_Lucene_Field::Keyword('id', $informationObject->id));
    $doc->addField(Zend_Search_Lucene_Field::Keyword('slug', $informationObject->slug));
    $doc->addField(Zend_Search_Lucene_Field::Keyword('culture', $language));
    $doc->addField(Zend_Search_Lucene_Field::Keyword('className', 'QubitInformationObject'));

    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('parentId', $informationObject->parentId));
    $doc->addField(Zend_Search_Lucene_Field::Keyword('parent', $informationObject->parent->slug));

    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('collectionRootId', $informationObject->getCollectionRoot()->id));
    $doc->addField(Zend_Search_Lucene_Field::Keyword('collectionRootSlug', $informationObject->getCollectionRoot()->slug));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('collectionRootTitle', $informationObject->getCollectionRoot()->getTitle()));

    // Digital object information
    if ($digitalObject = $informationObject->getDigitalObject())
    {
      $doc->addField(Zend_Search_Lucene_Field::Keyword('hasDigitalObject', 'true'));

      $doc->addField(Zend_Search_Lucene_Field::Keyword('do_mediaTypeId', $digitalObject->mediaTypeId));

      if (null !== $digitalObject->thumbnail)
      {
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('do_thumbnail_FullPath', $digitalObject->thumbnail->getFullPath()));
      }

      // $doc->addField(Zend_Search_Lucene_Field::Unstored('mediatype', $digitalObject->getMediaType()->getName(array('culture' => $language))));
      // $doc->addField(Zend_Search_Lucene_Field::Unstored('filename', $digitalObject->getName()));
      // $doc->addField(Zend_Search_Lucene_Field::Unstored('mimetype', $digitalObject->mimeType));
    }
    else
    {
      $doc->addField(Zend_Search_Lucene_Field::Keyword('hasDigitalObject', 'false'));
    }

    // Title
    // include an i18n fallback for proper search result display in case the title field was not translated
    if (0 < strlen($informationObject->getTitle(array('culture' => $language))))
    {
      $titleField = Zend_Search_Lucene_Field::Text('title', $informationObject->getTitle(array('culture' => $language)));
    }
    else
    {
      $titleField = Zend_Search_Lucene_Field::Text('title', $informationObject->getTitle(array('sourceCulture' => true)));
    }

    // Boost the hit relevance for the title field
    $titleField->boost = 10;
    $doc->addField($titleField);

    // Publication status
    $doc->addField(Zend_Search_Lucene_Field::Text('publicationStatusId', $informationObject->getPublicationStatus()->status->id));

    $doc->addField(Zend_Search_Lucene_Field::Text('scopeAndContent', $informationObject->getScopeAndContent(array('culture' => $language))));

    $doc->addField(Zend_Search_Lucene_Field::Text('referenceCode', $informationObject->referenceCode));

    // Store dates as serialized array
    $dates = array();
    foreach ($informationObject->getDates() as $date)
    {
      $save_date['id'] = $date->id;
      $save_date['rendered'] = Qubit::renderDateStartEnd($date->getDate(array('cultureFallback' => true)), $date->startDate, $date->endDate);
      $save_date['type'] = $date->getType(array('cultureFallback' => true))->__toString();

      if (isset($date->actor))
      {
        $save_date['actor'] = $date->actor->__toString();
      }

      $dates[] = $save_date;
    }

    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('dates', serialize($dates)));

    // CREATOR
    $creatorField = Zend_Search_Lucene_Field::Unstored('creator', $informationObject->getCreatorsNameString(array('culture' => $language)));
    // Boost the hit relevance for the creator field
    $creatorField->boost = 8;
    $doc->addField($creatorField);
    $doc->addField(Zend_Search_Lucene_Field::Unstored('creatorhistory', $informationObject->getCreatorsHistoryString(array('culture' => $language))));

    // Level of Description
    if (null !== $informationObject->getLevelOfDescription())
    {
      $doc->addField(Zend_Search_Lucene_Field::Text('levelOfDescription', $informationObject->getLevelOfDescription()->getName(array('culture' => $language))));
    }
    else
    {
      $doc->addField(Zend_Search_Lucene_Field::UnIndexed('levelOfDescription', null));
    }

    // Repository
    $repository = $informationObject->getRepository(array('inherit' => true));
    if (null !== $repository)
    {
      $doc->addField(Zend_Search_Lucene_Field::Keyword('repositoryId', $repository->id));
      $doc->addField(Zend_Search_Lucene_Field::Keyword('repositorySlug', $repository->slug));
      $doc->addField(Zend_Search_Lucene_Field::Text('repositoryName', $repository->getAuthorizedFormOfName(array('culture' => $language))));
    }
    else
    {
      $doc->addField(Zend_Search_Lucene_Field::UnIndexed('repositoryId', null));
      $doc->addField(Zend_Search_Lucene_Field::UnIndexed('repositorySlug', null));
      $doc->addField(Zend_Search_Lucene_Field::UnIndexed('repositoryName', null));
    }

    // Identifier
    $identifierField = Zend_Search_Lucene_Field::Text('identifier', $informationObject->getIdentifier());
    $identifierField->boost = 5;
    $doc->addField($identifierField);

    // I18n fields
    $doc->addField(Zend_Search_Lucene_Field::Unstored('alternatetitle', $informationObject->getAlternateTitle(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('edition', $informationObject->getEdition(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('extentandmedium', $informationObject->getExtentAndMedium(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('archivalhistory', $informationObject->getArchivalHistory(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('acquisition', $informationObject->getAcquisition(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('appraisal', $informationObject->getAppraisal(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('accruals', $informationObject->getAccruals(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('arrangement', $informationObject->getArrangement(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('accessconditions', $informationObject->getAccessConditions(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('reproductionconditions', $informationObject->getReproductionConditions(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('physicalcharacteristics', $informationObject->getPhysicalCharacteristics(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('findingaids', $informationObject->getFindingAids(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('locationoforiginals', $informationObject->getLocationOfOriginals(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('locationofcopies', $informationObject->getLocationOfCopies(array('culture' => $language))));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('relatedunitsofdescription', $informationObject->getRelatedUnitsOfDescription(array('culture' => $language))));

    // Subjects
    $subjectField = Zend_Search_Lucene_Field::Unstored('subject', $informationObject->getAccessPointsString(QubitTaxonomy::SUBJECT_ID, array('culture' => $language)));
    // Boost the hit relevance for the subject field
    $subjectField->boost = 5;
    $doc->addField($subjectField);

    // Place
    $placeField = Zend_Search_Lucene_Field::Unstored('place', $informationObject->getAccessPointsString(QubitTaxonomy::PLACE_ID, array('culture' => $language)));
    // Boost the hit relevance for the place field
    $placeField->boost = 3;
    $doc->addField($placeField);

    // Names
    $nameField = Zend_Search_Lucene_Field::Unstored('name', $informationObject->getNameAccessPointsString(array('culture' => $language)));
    // Boost the hit relevance for the place field
    $nameField->boost = 3;
    $doc->addField($nameField);

    $cultureInfo = sfCultureInfo::getInstance($language);
    $languages = $cultureInfo->getLanguages();
    $scripts = $cultureInfo->getScripts();

    // Languages
    if (0 < count($properties = $informationObject->getProperties($name = 'language')))
    {
      $languageCodes = unserialize($properties->offsetGet(0)->getValue(array('sourceCulture' => true)));

      if (0 < count($languageCodes))
      {
        $languageString = '';
        foreach ($languageCodes as $languageCode)
        {
          $languageString .= $languages[$languageCode].' ';
        }
        $doc->addField(Zend_Search_Lucene_Field::Unstored('language', rtrim($languageString)));
      }
    }

    // Scripts
    if (0 < count($properties = $informationObject->getProperties($name = 'script')))
    {
      $scriptCodes = unserialize($properties->offsetGet(0)->getValue(array('sourceCulture' => true)));

      if (0 < count($scriptCodes))
      {
        $scriptString = '';
        foreach ($scriptCodes as $scriptCode)
        {
          $scriptString .= $scripts[$scriptCode].' ';
        }
        $doc->addField(Zend_Search_Lucene_Field::Unstored('script', rtrim($scriptString)));
      }
    }

    // Notes
    if (0 < count($notes = $informationObject->getNotes()))
    {
      $noteString = '';
      foreach ($notes as $note)
      {
        $noteString .= $note->getContent(array('culture' => $language)).' ';
      }
      $doc->addField(Zend_Search_Lucene_Field::Unstored('notes', $noteString));
    }

    // Exclude control area fields for now, maybe add a seperate index for administrative data?
    // (institution_responsible_identifier, rules, sources, revision_history)

    // To come:
    // Add all dynamic metadata fields to index
    self::getInstance()->getEngine()->getIndex()->addDocument($doc);
  }
}
