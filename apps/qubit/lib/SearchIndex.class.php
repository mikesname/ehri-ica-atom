<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

class SearchIndex
{
  public static function getIndexLocation($object = 'informationobject', $language = 'en')
  {
    return sfConfig::get('sf_data_dir').'/index/'.$language;
  }

  public static function getIndexAnalyzer()
  {
  $index_analyzer = new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num;

  return $index_analyzer;
  }

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

  public static function getTranslatedLanguages(QubitInformationObject $informationObject)
  {
  $criteria = new Criteria;
  $criteria->add(QubitInformationObjectI18n::ID, $informationObject->getId());
  $translatedInformationObjects = QubitInformationObjectI18n::get($criteria);
  $translatedLanguages = array();
  foreach ($translatedInformationObjects as $I18nInformationObject)
    {
    $translatedLanguages[] = $I18nInformationObject->getCulture();
    }

  return $translatedLanguages;
  }

  public static function BuildIndex()
  {
    //build an index for each language
    foreach (self::getEnabledI18nLanguages() as $code => $language)
    {
      setlocale(LC_CTYPE, $code.'.utf-8');

      $index = Zend_Search_Lucene::create(self::getIndexLocation('informationobject', $code));
      Zend_Search_Lucene_Analysis_Analyzer::setDefault(self::getIndexAnalyzer());

      $criteria = new Criteria;
      $criteria->addJoin(QubitInformationObject::ID, QubitInformationObjectI18n::ID);
      $criteria->add(QubitInformationObjectI18n::CULTURE, $code);
      $informationObjects = QubitInformationObject::get($criteria);
      foreach ($informationObjects as $informationObject)
      {
        $doc = self::createIndexDocument($informationObject, $code);
        $index->addDocument($doc);
      }
    }
  }

  public static function updateIndexDocument(QubitInformationObject $informationObject, $language)
  {
  setlocale(LC_CTYPE, $language.'.utf-8');

  $index = Zend_Search_Lucene::open(self::getIndexLocation('informationobject', $language));
  Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num());

  //first delete existing index entries for this information object
  $term =  new Zend_Search_Lucene_Index_Term($informationObject->getId(), 'informationObjectId');
  $query = new Zend_Search_Lucene_Search_Query_Term($term);
  $hits = array();
  $hits  = $index->find($query);

  foreach ($hits as $hit)
    {
      $index->delete($hit->id);
    }

  //create and add document to index
  $doc = self::createIndexDocument($informationObject, $language);

  $index->addDocument($doc);
  }

  public static function updateTranslatedLanguages(QubitInformationObject $informationObject)
  {
    foreach (self::getTranslatedLanguages($informationObject) as $code)
    {
      self::updateIndexDocument($informationObject, $code);
    }
  }

  private static function createIndexDocument(QubitInformationObject $informationObject, $language, $encoding='utf-8')
  {
    $doc = new Zend_Search_Lucene_Document;

    // ID
    $doc->addField(Zend_Search_Lucene_Field::Keyword('informationObjectId', $informationObject->getId()));

    // Note: text fields have to be converted to lower-case for use with utf-8 analyzer

    // TITLE
    $titleField = Zend_Search_Lucene_Field::Unstored('title', strtolower($informationObject->getTitle(array('culture' => $language))), $encoding);
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

    // CREATOR
    $creatorField = Zend_Search_Lucene_Field::Unstored('creator', strtolower($informationObject->getCreatorsNameString($language)), $encoding);
    //boost the hit relevance for the creator field
    $creatorField->boost = 8;
    $doc->addField($creatorField);
    $doc->addField(Zend_Search_Lucene_Field::Unstored('creatorhistory', strtolower($informationObject->getCreatorsHistoryString($language)), $encoding));

    //CREATION DATES
    if (count($dates = $informationObject->getDates($eventType = 'creation')) > 0)
    {
      $doc->addField(Zend_Search_Lucene_Field::Text('dates', strtolower(implode(' ', $dates))));
    }

    // SCOPE AND CONTENT
    $doc->addField(Zend_Search_Lucene_Field::Unstored('scopeandcontent', strtolower($informationObject->getScopeAndContent(array('culture' => $language))), $encoding));
    //store an unindexed, case-sensitive copy of the scope & content field for use in hit display
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('display_scopeandcontent', $informationObject->getScopeAndContent(array('culture' => $language)), $encoding));

    // REPOSITORY
    //
    // The following cast to (string) should not be required, but PHP <= 5.2.5
    // dies without it.  This is a very difficult bug to reproduce.  For
    // example, var_dump(strtolower($informationObject->getRepository())); in
    // this function causes PHP to die, however it works when moved to the
    // calling function.  Returning a string constant from __toString() causes
    // strtolower($informationObject->getRepository()) to work, however calling
    // getAuthorizedFormOfName() in __toString() before returning the string
    // constant causes PHP to die, even though getAuthorizedFormOfName()
    // correctly returns a string.
    //
    // Options for locating this bug might include using Xdebug, running PHP
    // under gdb, or trying a PHP snapshot to see if it is resolved.
    $doc->addField(Zend_Search_Lucene_Field::Unstored('repository', strtolower((string) $informationObject->getRepository()), $encoding));

   // I18N FIELDS
    $doc->addField(Zend_Search_Lucene_Field::Unstored('alternatetitle', strtolower($informationObject->getAlternateTitle(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('version', strtolower($informationObject->getVersion(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('extentandmedium', strtolower($informationObject->getExtentAndMedium(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('archivalhistory', strtolower($informationObject->getArchivalHistory(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('acquisition', strtolower($informationObject->getAcquisition(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('appraisal', strtolower($informationObject->getAppraisal(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('accruals', strtolower($informationObject->getAccruals(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('arrangement', strtolower($informationObject->getArrangement(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('accessconditions', strtolower($informationObject->getAccessConditions(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('reproductionconditions', strtolower($informationObject->getReproductionConditions(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('physicalcharacteristics', strtolower($informationObject->getPhysicalCharacteristics(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('findingaids', strtolower($informationObject->getFindingAids(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('locationoforiginals', strtolower($informationObject->getLocationOfOriginals(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('locationofcopies', strtolower($informationObject->getLocationOfCopies(array('culture' => $language))), $encoding));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('relatedunitsofdescription', strtolower($informationObject->getRelatedUnitsOfDescription(array('culture' => $language))), $encoding));

   // COLLECTION ROOT
   if ($informationObject->getCollectionRoot())
   {
     $doc->addField(Zend_Search_Lucene_Field::UnIndexed('collectionid', $informationObject->getCollectionRoot()->getId()));
     $doc->addField(Zend_Search_Lucene_Field::UnIndexed('collectiontitle', $informationObject->getCollectionRoot()->getTitle(), $encoding));
   }
   else
   {
     $doc->addField(Zend_Search_Lucene_Field::UnIndexed('collectionid', null));
     $doc->addField(Zend_Search_Lucene_Field::UnIndexed('collectiontitle', null));
   }

   // SUBJECTS
    $subjectField = Zend_Search_Lucene_Field::Unstored('subject', strtolower($informationObject->getSubjectsString($language)), $encoding);
   //boost the hit relevance for the subject field
    $subjectField->boost = 5;
    $doc->addField($subjectField);

   // PLACE
    $placeField = Zend_Search_Lucene_Field::Unstored('place', strtolower($informationObject->getPlacesString($language)), $encoding);
   //boost the hit relevance for the place field
    $placeField->boost = 3;
    $doc->addField($placeField);

    // NAMES
    $nameField = Zend_Search_Lucene_Field::Unstored('name', strtolower($informationObject->getNameAccessPointsString($language)), $encoding);
   //boost the hit relevance for the place field
    $nameField->boost = 3;
    $doc->addField($nameField);

   // DIGITAL OBJECTS
   if ($informationObject->getDigitalObject())
   {
      $doc->addField(Zend_Search_Lucene_Field::Unstored('mediatype', strtolower($informationObject->getDigitalObject()->getMediaType(array('culture' => $language))), $encoding));
      $doc->addField(Zend_Search_Lucene_Field::Unstored('filename', strtolower($informationObject->getDigitalObject()->getName(array('culture' => $language))), $encoding));
      $doc->addField(Zend_Search_Lucene_Field::Unstored('mimetype', strtolower($informationObject->getDigitalObject()->getMimeType(array('culture' => $language))), $encoding));
   }

   $cultureInfo = new sfCultureInfo($language);

   // LANGUAGES
  if (count($languageCodes = $informationObject->getProperties($name = 'information_object_language')) > 0)
  {
    $languages = $cultureInfo->getLanguages();

    $languageString = '';
    foreach ($languageCodes as $languageCode)
    {
      $languageString .= $languages[$languageCode->getValue()].' ';
    }
    $doc->addField(Zend_Search_Lucene_Field::Unstored('language', strtolower($languageString), $encoding));
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
    $doc->addField(Zend_Search_Lucene_Field::Unstored('script', strtolower($scriptString), $encoding));
  }

   // NOTES
   if (count($notes = $informationObject->getNotes()) > 0)
   {
      $noteString = '';
      foreach ($notes as $note)
      {
        $noteString .= $note.' ';
      }
      $doc->addField(Zend_Search_Lucene_Field::Unstored('notes', strtolower($noteString), $encoding));
   }

    // exclude control area fields for now, maybe add a seperate index for administrative data?
    // (institution_responsible_identifier, rules, sources, revision_history)

   //TO COME:
   //add all dynamic metadata fields to index

    return $doc;
}

  public static function deleteIndexDocument($informationObject)
  {
    //delete the document in each language index
    foreach (self::getEnabledI18nLanguages() as $code => $language)
    {
      $index = Zend_Search_Lucene::open(self::getIndexLocation('informationobject', $code));
      Zend_Search_Lucene_Analysis_Analyzer::setDefault(self::getIndexAnalyzer());

      $term =  new Zend_Search_Lucene_Index_Term($informationObject->getId(), 'informationObjectId');
      $query = new Zend_Search_Lucene_Search_Query_Term($term);
      $hits = array();
      $hits  = $index->find($query);

      foreach ($hits as $hit)
      {
        $index->delete($hit->id);
      }
    }
  }
}
