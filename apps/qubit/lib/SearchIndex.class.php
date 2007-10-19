<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class SearchIndex
{

  public static function getIndexLocation()
  {
  $index_location = SF_ROOT_DIR.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'search_index';

  return $index_location;
  }

  public static function getIndexAnalyzer()
  {
  $index_analyzer = new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num();

  return $index_analyzer;
  }

  public static function BuildIndex()
  {
  setlocale(LC_CTYPE, 'en_US.utf-8');

  $index = Zend_Search_Lucene::create(self::getIndexLocation());
  Zend_Search_Lucene_Analysis_Analyzer::setDefault(self::getIndexAnalyzer());

  $informationObjects = informationObjectPeer::doSelect(new Criteria());
  foreach ($informationObjects as $informationObject)
      {
      $doc = self::createIndexDocument($informationObject);

      $index->addDocument($doc);
      }

  }

  public static function updateIndexDocument($id)
  {
  setlocale(LC_CTYPE, 'en_US.utf-8');

  $index = Zend_Search_Lucene::open(self::getIndexLocation());
  Zend_Search_Lucene_Analysis_Analyzer::setDefault(self::getIndexAnalyzer());

  $informationObject = informationObjectPeer::retrieveByPk($id);

  //first delete existing index entries for this informationObject
  $term =  new Zend_Search_Lucene_Index_Term($informationObject->getId(), 'informationObjectId');
  $query = new Zend_Search_Lucene_Search_Query_Term($term);
  $hits = array();
  $hits  = $index->find($query);

  foreach ($hits AS $hit)
    {
      $index->delete($hit->id);
    }

  //create and add document to index
  $doc = self::createIndexDocument($informationObject);

  $index->addDocument($doc);


  }

  private static function createIndexDocument($informationObject)
  {
    $doc = new Zend_Search_Lucene_Document();

    $doc->addField(Zend_Search_Lucene_Field::Keyword('informationObjectId', $informationObject->getId()));

    //boost the hit relevance for the title field
    $titleField = Zend_Search_Lucene_Field::Unstored('title', strtolower($informationObject->getTitle()));
    $titleField->boost = 10;
    $doc->addField($titleField);

    $doc->addField(Zend_Search_Lucene_Field::Unstored('scopeandcontent', strtolower($informationObject->getScopeAndContent())));

    //boost the hit relevance for the creator field
    $creatorField = Zend_Search_Lucene_Field::Unstored('creator', strtolower($informationObject->getCreatorsNameString()));
    $creatorField->boost = 8;
    $doc->addField($creatorField);

    $doc->addField(Zend_Search_Lucene_Field::Unstored('creatorhistory', strtolower($informationObject->getCreatorsHistoryString())));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('repository', strtolower($informationObject->getRepository())));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('repositorycountry', strtolower($informationObject->getRepositoryCountry())));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('extentandmedium', strtolower($informationObject->getExtentAndMedium())));

    //boost the hit relevance for the subject field
    $subjectField = Zend_Search_Lucene_Field::Unstored('subject', strtolower($informationObject->getSubjectsString()));
    $subjectField->boost = 5;
    $doc->addField($subjectField);

    //fields have to be converted to lower-case for use with utf-8 analyzer
    //store unindexed, case-sensitive copies of fields for use in hit display
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('display_title', $informationObject->getTitle(), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('display_scopeandcontent', $informationObject->getScopeAndContent(), 'utf-8'));

    return $doc;

}

public static function deleteIndexDocument($informationObjectId)
  {
  $index = Zend_Search_Lucene::open(self::getIndexLocation());
  Zend_Search_Lucene_Analysis_Analyzer::setDefault(self::getIndexAnalyzer());

  $term =  new Zend_Search_Lucene_Index_Term($informationObjectId, 'informationObjectId');
  $query = new Zend_Search_Lucene_Search_Query_Term($term);
  $hits = array();
  $hits  = $index->find($query);

  foreach ($hits as $hit)
    {
    $index->delete($hit->id);
    }

  }

}
