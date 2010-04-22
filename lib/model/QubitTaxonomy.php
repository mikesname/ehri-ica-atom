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

class QubitTaxonomy extends BaseTaxonomy
{
  const ROOT_ID = 30;
  const DESCRIPTION_DETAIL_LEVEL_ID = 31;
  const ACTOR_ENTITY_TYPE_ID = 32;
  const DESCRIPTION_STATUS_ID = 33;
  const LEVEL_OF_DESCRIPTION_ID = 34;
  const SUBJECT_ID = 35;
  const ACTOR_NAME_TYPE_ID = 36;
  const NOTE_TYPE_ID = 37;
  const REPOSITORY_TYPE_ID = 38;
  const EVENT_TYPE_ID = 40;
  const QUBIT_SETTING_LABEL_ID = 41;
  const PLACE_ID = 42;
  const FUNCTION_ID = 43;
  const HISTORICAL_EVENT_ID = 44;
  const COLLECTION_TYPE_ID = 45;
  const MEDIA_TYPE_ID = 46;
  const DIGITAL_OBJECT_USAGE_ID = 47;
  const PHYSICAL_OBJECT_TYPE_ID = 48;
  const RELATION_TYPE_ID = 49;
  const MATERIAL_TYPE_ID = 50;
  const RAD_NOTE_ID = 51; //CCA Rules for Archival Description (RAD) taxonomies
  const RAD_TITLE_NOTE_ID = 52; //CCA Rules for Archival Description (RAD) taxonomies
  const MODS_RESOURCE_TYPE_ID = 53;
  const DC_TYPE_ID = 54;
  const ACTOR_RELATION_TYPE_ID = 55;
  const RELATION_NOTE_TYPE_ID = 56;
  const TERM_RELATION_TYPE_ID = 57;
  const STATUS_TYPE_ID = 59;
  const PUBLICATION_STATUS_ID = 60;
  const ISDF_RELATION_TYPE_ID = 61;

  public static $lockedTaxonomies = array(
    self::QUBIT_SETTING_LABEL_ID,
    self::COLLECTION_TYPE_ID,
    self::DIGITAL_OBJECT_USAGE_ID,
    self::MEDIA_TYPE_ID,
    self::RELATION_TYPE_ID,
    self::RELATION_NOTE_TYPE_ID,
    self::TERM_RELATION_TYPE_ID,
    self::ROOT_ID,
    self::STATUS_TYPE_ID,
    self::PUBLICATION_STATUS_ID,
    self::ACTOR_ENTITY_TYPE_ID,
    self::ACTOR_NAME_TYPE_ID
  );

  public function __toString()
  {
    if (!$this->getName())
    {
      return (string) $this->getName(array('sourceCulture' => true));
    }

    return (string) $this->getName();
  }

  public static function getRoot()
  {
    return parent::getById(self::ROOT_ID);
  }

  public static function addEditableTaxonomyCriteria($criteria)
  {
    $criteria->add(QubitTaxonomy::ID, self::$lockedTaxonomies, Criteria::NOT_IN);

    return $criteria;
  }

  public static function getEditableTaxonomies()
  {
    $criteria = new Criteria;
    $criteria = self::addEditableTaxonomyCriteria($criteria);

    // Add criteria to sort by name with culture fallback
    $criteria->addAscendingOrderByColumn('name');
    $options = array('returnClass'=>'QubitTaxonomy');
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTaxonomy', $options);

    return QubitTaxonomy::get($criteria);
  }

  public static function getTaxonomyTerms($taxonomyId, $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, $taxonomyId, Criteria::EQUAL);

    // Only include top-level terms if option is set
    if (isset($options['level']) && $options['level'] == 'top')
    {
      $criteria->add(QubitTerm::PARENT_ID, QubitTerm::ROOT_ID, Criteria::EQUAL);
    }

    // Exclude non-preferred terms
    $criteria->addJoin(QubitTerm::ID, QubitRelation::OBJECT_ID, Criteria::LEFT_JOIN);
    $criterion1 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID, Criteria::NOT_EQUAL);
    $criterion2 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, null, Criteria::ISNULL);
    $criterion1->addOr($criterion2);
    $criteria->add($criterion1);

    // Sort alphabetically
    $criteria->addAscendingOrderByColumn('name');

    // Do source culture fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');

    return QubitTerm::get($criteria);
  }
}
