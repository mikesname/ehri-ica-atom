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
  const DESCRIPTION_DETAIL_LEVEL_ID = 1;
  const ACTOR_ENTITY_TYPE_ID = 2;
  const DESCRIPTION_STATUS_ID = 3;
  const LEVEL_OF_DESCRIPTION_ID = 4;
  const SUBJECT_ID = 5;
  const ACTOR_NAME_TYPE_ID = 6;
  const NOTE_TYPE_ID = 7;
  const REPOSITORY_TYPE_ID = 8;
  const ACTOR_ROLE_ID = 9;
  const EVENT_TYPE_ID = 10;
  const QUBIT_SETTING_LABEL_ID = 11;
  const PLACE_ID = 12;
  const FUNCTION_ID = 13;
  const HISTORICAL_EVENT_ID = 14;
  const COLLECTION_TYPE_ID = 15;
  const MEDIA_TYPE_ID = 16;
  const DIGITAL_OBJECT_USAGE_ID = 17;
  const PHYSICAL_OBJECT_TYPE_ID = 18;
  const RELATION_TYPE_ID = 19;
  const MATERIAL_TYPE_ID = 20;
  const RAD_NOTE_ID = 21; //CCA Rules for Archival Description (RAD) taxonomies
  const RAD_TITLE_NOTE_ID = 22; //CCA Rules for Archival Description (RAD) taxonomies
  const MODS_RESOURCE_TYPE_ID = 23;
  const DC_TYPE_ID = 24;
  const ACTOR_RELATION_TYPE_ID = 25;
  const RELATION_NOTE_TYPE_ID = 26;
  const TERM_RELATION_TYPE_ID = 27;
  const ROOT_ID = 28;
  const STATUS_TYPE_ID = 29;
  const PUBLICATION_STATUS_ID = 30;

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
    self::PUBLICATION_STATUS_ID
  );

  public function __toString()
  {
    if (!$this->getName())
    {
      return (string) $this->getName(array('sourceCulture' => true));
    }

    return (string) $this->getName();
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
}
