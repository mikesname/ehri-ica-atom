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

class TermPeer extends BaseTerm
{
 
  public static function getActorRelationTypes()
    {
    return self::getTaxonomy($taxonomyId = 1, $sort, $restrict = false);
    }

  public static function getActorRoles()
    {
    return self::getTaxonomy($taxonomyId = 2, $sort, $restrict = false);
    }

  public static function getGeographicRegions()
    {
    return self::getTaxonomy($taxonomyId = 8);
    }

  public static function getInstitutionCategories()
    {
    return self::getTaxonomy($taxonomyId = 9);
    }

  public static function getMediaTypes()
    {
    return self::getTaxonomy($taxonomyId = 12);
    }

  public static function getMaterialTypes()
    {
    return self::getTaxonomy($taxonomyId = 11, $sort, $restrict = false);
    }

  public static function getCredentials()
  {
  return self::getTaxonomy($taxonomyId = 15, $sort, $restrict = false);
  }

public static function getRepositoryCountryHitList()
  {
  $countries = self::getCountries();

  $criteria = new Criteria;
  $repositories = QubitRepository::get($criteria);

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

    $criteria = new Criteria;
    $languageRelations = QubitObjectTermRelation::get($criteria);

    $languageList = array();

    foreach ($languages as $language)
    {
    $hitCount = null;
    foreach ($languageRelations as $languageRelation)
      {
      if ($language->getId() == $languageRelation->getTermId())
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

  $criteria = new Criteria;
  $subjectRelations = QubitObjectTermRelation::get($criteria);

  $subjectList = array();

  foreach ($subjects as $subject)
    {
    $hitCount = null;
    foreach ($subjectRelations as $subjectRelation)
      {
      if ($subject->getId() == $subjectRelation->getTermId())
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
