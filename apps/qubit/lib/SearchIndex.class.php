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
 * Create and populate the Zend Search Lucene search index
 *
 * @package    qubit
 * @subpackage search
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class SearchIndex
{
  /**
   * Wrapper for selecting proper search index analyzer
   *
   * @return mixed Zend Search analyzer
   */
  public static function getIndexAnalyzer()
  {
    $index_analyzer = new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive;

    return $index_analyzer;
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
      $stmt->execute(array($object->getId()));

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

  /**
   * Update the index document for each translation of the given $object
   *
   * @param mixed $object Object to update
   * @return void
   */
  public static function updateTranslatedLanguages($object)
  {
    xfLuceneZendManager::load();
    Zend_Search_Lucene_Analysis_Analyzer::setDefault(self::getIndexAnalyzer());

    foreach (self::getTranslatedLanguages($object) as $languageCode)
    {
      self::updateIndexDocument($object, $languageCode);
    }
  }

  /**
   * Pass document creation to the appropriate method
   *
   * @param mixed $object ORM object
   * @param string $language ISO-639-1 language code
   * @param string $encoding encoding code
   * @return void
   */
  public static function createIndexDocument($object, $language, $encoding='utf-8')
  {
    static $counter = 1;
    //echo 'Search index document #'.$counter.'<br/>';
    switch (get_class($object))
    {
      case 'QubitInformationObject':
        $doc = self::createInformationObjectDocument($object, $language, $options = array('encoding' => $encoding));
        break;
    }

    $counter++;
    return $doc;
  }

  /**
   * Delete an existing document from the index
   *
   * @param mixed $object ORM object
   * @param string $language ISO-639-1 code
   * @return void
   */
  public static function deleteIndexDocument($object, $language)
  {
    $search = new QubitSearch;

    $query = new Zend_Search_Lucene_Search_Query_MultiTerm;
    $query->addTerm(new Zend_Search_Lucene_Index_Term($object->id, 'id'), true);
    $query->addTerm(new Zend_Search_Lucene_Index_Term($language, 'culture'), true);
    foreach ($search->getEngine()->getIndex()->find($query) as $hit)
    {
      $search->getEngine()->getIndex()->delete($hit->id);
    }
  }

  /**
   * Delete from all search indexes
   *
   * @param mixed $object ORM object
   * @return void
   */
  public static function deleteTranslatedLanguages($object)
  {
    xfLuceneZendManager::load();
    Zend_Search_Lucene_Analysis_Analyzer::setDefault(self::getIndexAnalyzer());

    foreach (self::getEnabledI18nLanguages() as $code => $language)
    {
      self::deleteIndexDocument($object, $language);
    }
  }

  /**
   * Update = delete existing document + create new document
   *
   * @param mixed $object ORM object
   * @param string $language ISO-639-1 language code
   * @return void
   */
  public static function updateIndexDocument($object, $language)
  {
    // first delete existing index entries
    self::deleteIndexDocument($object, $language);

    $search = new QubitSearch;

    // create and add document to index
    $doc = self::createIndexDocument($object, $language);

    if (null !== $doc)
    {
      $search->getEngine()->getIndex()->addDocument($doc);
    }
  }

  /*********************************************************
    Document Creation
   *********************************************************/

  /**
   * Create an information object search index document
   *
   * @param QubitInformationObject $informationObject
   * @param string $language ISO-639-1 language code
   * @param array $options optional parameters
   * @return Zend_Search_Lucene_Document search index document
   */
  protected static function createInformationObjectDocument(QubitInformationObject $informationObject, $language, $options = array())
  {
    $encoding = (isset($options['encoding'])) ? $options['encoding'] : 'utf-8';

    $doc = new Zend_Search_Lucene_Document;

    $doc->addField(Zend_Search_Lucene_Field::Keyword('id', $informationObject->id));

    if (isset($informationObject->parent))
    {
      $doc->addField(Zend_Search_Lucene_Field::Keyword('parentId', $informationObject->parent->id));
    }

    $doc->addField(Zend_Search_Lucene_Field::Keyword('culture', $language));

    $doc->addField(Zend_Search_Lucene_Field::Unstored('publicationStatusId', $informationObject->getPublicationStatus()->statusId));

    // Note: text fields have to be converted to lower-case for use with utf-8 analyzer

    // IDENTIFIER
    $identifierField = Zend_Search_Lucene_Field::Unstored('identifier', $informationObject->getIdentifier(), $encoding);
    $identifierField->boost = 5;
    $doc->addField($identifierField);

    // TITLE
    $titleField = Zend_Search_Lucene_Field::Unstored('title', $informationObject->getTitle(array('culture' => $language)), $encoding);
    //boost the hit relevance for the title field
    $titleField->boost = 10;
    $doc->addField($titleField);
    //store an unindexed, case-sensitive copy of the title field for use in hit display
    if ($informationObject->getTitle(array('culture' => $language)))
    {
      $doc->addField(Zend_Search_Lucene_Field::UnIndexed('display_title', $informationObject->getTitle(array('culture' => $language)), $encoding));
    }
    else
    {
      //include an i18n fallback for proper search result display in case the title field was not translated
      $doc->addField(Zend_Search_Lucene_Field::UnIndexed('display_title', $informationObject->getTitle(array('sourceCulture' => true)), $encoding));
    }

    // LEVEL OF DESCRIPTION
    $doc->addField(Zend_Search_Lucene_Field::Unstored('levelofdescription', $informationObject->getLevelOfDescription(array('culture' => $language)), $encoding));
    //store an unindexed, case-sensitive copy of the scope & content field for use in hit display
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('display_levelofdescription', $informationObject->getLevelOfDescription(array('culture' => $language)), $encoding));

    // CREATOR
    $creatorField = Zend_Search_Lucene_Field::Unstored('creator', $informationObject->getCreatorsNameString($language), $encoding);
    //boost the hit relevance for the creator field
    $creatorField->boost = 8;
    $doc->addField($creatorField);
    $doc->addField(Zend_Search_Lucene_Field::Unstored('creatorhistory', $informationObject->getCreatorsHistoryString($language), $encoding));

    //DATES
    if (count($dates = $informationObject->getDatesString()) > 0)
    {
      $doc->addField(Zend_Search_Lucene_Field::Text('dates', $dates));
    }

    // SCOPE AND CONTENT
    $doc->addField(Zend_Search_Lucene_Field::Unstored('scopeandcontent', $informationObject->getScopeAndContent(array('culture' => $language)), $encoding));

    // REPOSITORY
    $repository = $informationObject->getRepository(array('inherit' => true));
    if (null !== $repository)
    {
      $doc->addField(Zend_Search_Lucene_Field::Keyword('repositoryid', $repository->getId()), $encoding);
      $doc->addField(Zend_Search_Lucene_Field::Unstored('repository', $repository->getAuthorizedFormOfName(), $encoding));
    }
    else
    {
      $doc->addField(Zend_Search_Lucene_Field::Unindexed('repositoryid', null, $encoding));
      $doc->addField(Zend_Search_Lucene_Field::Unstored('repository', null, $encoding));
    }

    // I18N FIELDS
    $doc->addField(Zend_Search_Lucene_Field::Unstored('alternatetitle', $informationObject->getAlternateTitle(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('edition', $informationObject->getEdition(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('extentandmedium', $informationObject->getExtentAndMedium(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('archivalhistory', $informationObject->getArchivalHistory(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('acquisition', $informationObject->getAcquisition(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('appraisal', $informationObject->getAppraisal(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('accruals', $informationObject->getAccruals(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('arrangement', $informationObject->getArrangement(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('accessconditions', $informationObject->getAccessConditions(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('reproductionconditions', $informationObject->getReproductionConditions(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('physicalcharacteristics', $informationObject->getPhysicalCharacteristics(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('findingaids', $informationObject->getFindingAids(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('locationoforiginals', $informationObject->getLocationOfOriginals(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('locationofcopies', $informationObject->getLocationOfCopies(array('culture' => $language)), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('relatedunitsofdescription', $informationObject->getRelatedUnitsOfDescription(array('culture' => $language)), $encoding));

    // SUBJECTS
    $subjectField = Zend_Search_Lucene_Field::Unstored('subject', $informationObject->getSubjectsString($language), $encoding);
    //boost the hit relevance for the subject field
    $subjectField->boost = 5;
    $doc->addField($subjectField);

    // PLACE
    $placeField = Zend_Search_Lucene_Field::Unstored('place', $informationObject->getPlacesString($language), $encoding);
    //boost the hit relevance for the place field
    $placeField->boost = 3;
    $doc->addField($placeField);

    // NAMES
    $nameField = Zend_Search_Lucene_Field::Unstored('name', $informationObject->getNameAccessPointsString($language), $encoding);
    //boost the hit relevance for the place field
    $nameField->boost = 3;
    $doc->addField($nameField);

    $cultureInfo = sfCultureInfo::getInstance($language);

    // LANGUAGES
    if (count($languageCodes = $informationObject->getProperties($name = 'information_object_language')) > 0)
    {
      $languages = $cultureInfo->getLanguages();

      $languageString = '';
      foreach ($languageCodes as $languageCode)
      {
        $languageString .= $languages[$languageCode->getValue()].' ';
      }
      $doc->addField(Zend_Search_Lucene_Field::Unstored('language', $languageString, $encoding));
    }

    // SCRIPTS
    if (count($scriptCodes = $informationObject->getProperties($name = 'information_object_script')) > 0)
    {
      $scripts = $cultureInfo->getScripts();

      $scriptString = '';
      foreach ($scriptCodes as $scriptCode)
      {
        $scriptString .= $scripts[$scriptCode->getValue()].' ';
      }
      $doc->addField(Zend_Search_Lucene_Field::Unstored('script', $scriptString, $encoding));
    }

    // NOTES
    if (count($notes = $informationObject->getNotes()) > 0)
    {
      $noteString = '';
      foreach ($notes as $note)
      {
        $noteString .= $note.' ';
      }
      $doc->addField(Zend_Search_Lucene_Field::Unstored('notes', $noteString, $encoding));
    }

    // DIGITAL OBJECTS
    if (null !== ($digitalObject = $informationObject->getDigitalObject()))
    {
      if (isset($digitalObject->mediaType))
      {
        $doc->addField(Zend_Search_Lucene_Field::Unstored('mediatype', $digitalObject->getMediaType()->__toString()), $encoding);
      }

      $doc->addField(Zend_Search_Lucene_Field::Unstored('filename', $digitalObject->getName(), $encoding));
      $doc->addField(Zend_Search_Lucene_Field::Unstored('mimetype', $digitalObject->getMimeType(), $encoding));
    }

    // exclude control area fields for now, maybe add a seperate index for administrative data?
    // (institution_responsible_identifier, rules, sources, revision_history)

    //TO COME:
    //add all dynamic metadata fields to index

    return $doc;
  }
}
