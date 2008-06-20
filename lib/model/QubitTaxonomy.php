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

  public function __toString()
  {
    return (string) $this->getName();
  }
  
  public static function getEditableTaxonomies()
  {
    $criteria = new Criteria;
    $criteria->add(QubitTaxonomy::ID, array(QubitTaxonomy::QUBIT_SETTING_LABEL_ID), Criteria::NOT_IN);
  
    return QubitTaxonomy::get($criteria);
  }

}
