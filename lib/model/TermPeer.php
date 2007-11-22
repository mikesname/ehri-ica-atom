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

class TermPeer extends BaseTermPeer
{

  public static function getTaxonomy($taxonomyId = 0, $sort = 'default', $restrict = TRUE)
    {

    $c = new Criteria();

    //select a specific taxonomy
    if ($taxonomyId !== 0)
      {
      $c->add(TermPeer::TAXONOMY_ID, $taxonomyId);
      }

    //only include taxonomies that are approved for end-user viewing/editing
    if ($restrict == TRUE)
      {
      $c->add(TaxonomyPeer::TERM_USE, 'user');
      }

    switch($sort)
      {
      case 'idDown' :
        $c->addDescendingOrderByColumn(TermPeer::ID);
        break;
      case 'idUp' :
        $c->addAscendingOrderByColumn(TermPeer::ID);
        break;
      case 'termNameDown' :
        $c->addDescendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'termNameUp' :
        $c->addAscendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'sourceDown' :
        $c->addDescendingOrderByColumn(TermPeer::SOURCE);
        $c->addDescendingOrderByColumn(TaxonomyPeer::NAME);
        $c->addDescendingOrderByColumn(TermPeer::SORT_ORDER);
        $c->addDescendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'sourceUp' :
        $c->addAscendingOrderByColumn(TermPeer::SOURCE);
        $c->addAscendingOrderByColumn(TaxonomyPeer::NAME);
        $c->addAscendingOrderByColumn(TermPeer::SORT_ORDER);
        $c->addAscendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'sortOrderDown' :
        $c->addDescendingOrderByColumn(TaxonomyPeer::NAME);
        $c->addDescendingOrderByColumn(TermPeer::SORT_ORDER);
        $c->addDescendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'sortOrderUp' :
        $c->addAscendingOrderByColumn(TaxonomyPeer::NAME);
        $c->addAscendingOrderByColumn(TermPeer::SORT_ORDER);
        $c->addAscendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'taxonomyDown' :
        $c->addDescendingOrderByColumn(TaxonomyPeer::NAME);
        $c->addAscendingOrderByColumn(TermPeer::SORT_ORDER);
        $c->addAscendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'taxonomyUp' :
        $c->addAscendingOrderByColumn(TaxonomyPeer::NAME);
        $c->addAscendingOrderByColumn(TermPeer::SORT_ORDER);
        $c->addAscendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      case 'default' :
      default:
        $c->addAscendingOrderByColumn(TaxonomyPeer::NAME);
        $c->addAscendingOrderByColumn(TermPeer::SORT_ORDER);
        $c->addAscendingOrderByColumn(TermPeer::TERM_NAME);
        break;
      }

  return TermPeer::doSelectJoinTaxonomy($c);
  }

  public static function getTaxonomyBrowseList($taxonomyId = null, $sort = null, $objectType = null)
  {
  $c = new Criteria();
  $c->add(TermPeer::TAXONOMY_ID, $taxonomyId);

  switch($objectType)
    {
    case 'actor' :
      {
      $c->addJoin(TermPeer:: ID, ActorTermRelationshipPeer::TERM_ID, Criteria::RIGHT_JOIN);
      }
    case 'repository' :
      {
      $c->addJoin(TermPeer:: ID, RepositoryTermRelationshipPeer::TERM_ID, Criteria::RIGHT_JOIN);
      }
    case 'informationObject' :
    default :
      {
      $c->addJoin(TermPeer:: ID, InformationObjectTermRelationshipPeer::TERM_ID, Criteria::RIGHT_JOIN);
      }
    }

  switch($sort)
    {
    case 'termNameUp' :
      {
      $c->addAscendingOrderByColumn(TermPeer::TERM_NAME);
      }
    case 'termNameDown' :
      {
      $c->addDescendingOrderByColumn(TermPeer::TERM_NAME);
      }
    }

  $c->setDistinct(true);

  $terms = self::doSelect($c);
  $taxonomyBrowseList = array();

  foreach($terms as $term)
    {

    switch($objectType)
      {
      case 'actor' :
        {
        }
      case 'repository' :
        {
        }
      case 'informationObject' :
      default :
        {
        $c = new Criteria();
        $c->add(InformationObjectTermRelationshipPeer::TERM_ID, $term->getId());
        $hits = InformationObjectTermRelationshipPeer::doCount($c);
        }
      }

    $taxonomyBrowseList[] = array('termName' => $term->getTermName(), 'termId' => $term->getId(), 'hits' => $hits);
    }

  //use ArraySort helper
  switch($sort)
    {
    case 'hitsUp' :
      return ArraySort::termHitsSortUp($taxonomyBrowseList);
    case 'hitsDown' :
      return ArraySort::termHitsSortDown($taxonomyBrowseList);
    default :
      return $taxonomyBrowseList;
    }

  }


  public static function getActorRelationshipTypes()
    {

    return self::getTaxonomy($taxonomyId = 1, $sort, $restrict = FALSE);
    }

  public static function getActorRoles()
    {

    return self::getTaxonomy($taxonomyId = 2, $sort, $restrict = FALSE);
    }

  public static function getAuthorityFileDetail()
    {

    return self::getTaxonomy($taxonomyId = 3);
    }

  public static function getAuthorityFileEntityTypes()
    {

    return self::getTaxonomy($taxonomyId = 4);
    }

  public static function getAuthorityFileStatus()
    {

    return self::getTaxonomy($taxonomyId = 5);
    }

  public static function getCountries()
    {

    return self::getTaxonomy($taxonomyId = 6, $sort, $restrict = FALSE);
    }

   public static function getLevelsOfDescription()
    {

    //change $taxonomyId to use other LevelsOfDescription taxonomies
    return self::getTaxonomy($taxonomyId = 7);
    }


  public static function getGeographicRegions()
    {

    return self::getTaxonomy($taxonomyId = 8);
    }

  public static function getInstitutionCategories()
    {
    return self::getTaxonomy($taxonomyId = 9);
    }

  public static function getLanguages()
    {
    return self::getTaxonomy($taxonomyId = 10);
    }

  public static function getMediaTypes()
    {
    return self::getTaxonomy($taxonomyId = 12);
    }

  public static function getMaterialTypes()
    {
    return self::getTaxonomy($taxonomyId = 11, $sort, $restrict = FALSE);
    }

  public static function getScripts()
    {
    return self::getTaxonomy($taxonomyId = 13);
    }

  public static function getSubjects()
    {
    return self::getTaxonomy($taxonomyId = 14);
    }

  public static function getCredentials()
  {

  return self::getTaxonomy($taxonomyId = 15, $sort, $restrict = FALSE);
  }

  public static function getActorNameTypes()
  {

  return self::getTaxonomy($taxonomyId = 18);
  }

  public static function getNoteTypes()
  {

  return self::getTaxonomy($taxonomyId = 19);
  }

  public static function getRepositoryTypes()
  {

  return self::getTaxonomy($taxonomyId = 20);
  }

  public static function getI18nLanguages()
  {

  return self::getTaxonomy($taxonomyId = 27, $sort='default', $restrict = FALSE);
  }


public static function getRepositoryCountryHitList()
  {
  $countries = self::getCountries();

  $c = new Criteria();
  $repositories = RepositoryPeer::doSelect($c);

  $countryList = array();

  foreach ($countries as $country)
    {
    $hitCount = null;
    foreach ($repositories as $repository)
      {
       if ($repository->getCountryId() == $country->getId())
        {
        $hitCount += 1; }
        }
       if ($hitCount != null)
        {
        $country->setCountryHitCount($hitCount);
        array_push($countryList, $country);
        }
      }

    return $countryList;
  }


  public static function getLanguageHitList()
  {
    $languages = self::getLanguages();

    $c = new Criteria();
    $languageRelationships = InformationObjectTermRelationshipPeer::doSelect($c);

    $languageList = array();

    foreach ($languages as $language)
    {
    $hitCount = null;
    foreach ($languageRelationships as $languageRelationship)
      {
      if ($language->getId() == $languageRelationship->getTermId())
          {
          $hitCount += 1;
          }
      }
     if ($hitCount != null)
      {
      $language->setLanguageHitCount($hitCount);
      array_push($languageList, $language);
      }
    }

    return $languageList;
 }



public static function getSubjectHitList()
  {
  $subjects = self::getSubjects();

  $c = new Criteria();
  $subjectRelationships = InformationObjectTermRelationshipPeer::doSelect($c);

  $subjectList = array();

  foreach ($subjects as $subject)
    {
    $hitCount = null;
    foreach ($subjectRelationships as $subjectRelationship)
      {
      if ($subject->getId() == $subjectRelationship->getTermId())
          {
          $hitCount += 1;
          }
      }
      if ($hitCount != null)
      {
      $subject->setSubjectHitCount($hitCount);
      array_push($subjectList, $subject);
      }
    }

    return $subjectList;
  }




}
