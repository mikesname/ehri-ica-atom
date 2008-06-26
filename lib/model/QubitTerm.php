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

class QubitTerm extends BaseTerm
{
  //The following Term Ids are assigned constant values because they are used
  //in application code and can't rely on database id values, since these could be changed

  //ActorRole taxonomy
  const CREATOR_ID = 5;
  const CUSTODIAN_ID = 6;
  const PUBLISHER_ID = 7;
  const CONTRIBUTOR_ID = 8;
  const SUBJECT_ID = 9;
  const COLLECTOR_ID = 10;
  //EventType taxonomy
  const CREATION_ID = 11;
  const EXISTENCE_ID = 12;
  const CUSTODY_ID = 13;
  const PUBLICATION_ID = 14;
  const CONTRIBUTION_ID = 15;
  const SUBJECT_ACCESS_POINT_ID = 16;
  const COLLECTION_ID = 17;
  //NoteType taxonomy
  const TITLE_NOTE_ID = 25;
  const PUBLICATION_NOTE_ID = 26;
  //CollectionType taxonomy
  const ARCHIVAL_MATERIAL_ID = 27;
  const FINDING_AIDS_ID = 28;
  const PUBLISHED_MATERIAL_ID = 29;
  const ARTEFACT_MATERIAL_ID = 30;
  //ActorEntityType taxonomy
  const CORPORATE_BODY_ID = 31;
  const PERSON_ID = 32;
  const FAMILY_ID = 33;
  //OtherNameType taxonomy
  const FAMILY_NAME_FIRST_NAME_ID = 34;
  //MediaType taxonomy
  const AUDIO_ID = 35;
  const IMAGE_ID = 36;
  const TEXT_ID = 37;
  const VIDEO_ID = 38;
  const OTHER_ID = 39;
  //Digital Object Usage taxonomy
  const MASTER_ID = 40;
  const REFERENCE_ID = 41;
  const THUMBNAIL_ID = 42;
  //Physical Object Type taxonomy
  const LOCATION_ID = 43;
  const CONTAINER_ID = 44;
  const ARTEFACT_ID = 45;
  //Relation Type taxonomy
  const HAS_PHYSICAL_OBJECT_ID = 46;

  public function isProtected()
  {
    //The following terms cannot be edited by users because their values are used in application logic
    return $this->getId() == QubitTerm::CREATOR_ID ||
           $this->getId() == QubitTerm::CUSTODIAN_ID ||
           $this->getId() == QubitTerm::PUBLISHER_ID ||
           $this->getId() == QubitTerm::CONTRIBUTOR_ID ||
           $this->getId() == QubitTerm::CREATION_ID ||
           $this->getId() == QubitTerm::EXISTENCE_ID ||
           $this->getId() == QubitTerm::CUSTODY_ID ||
           $this->getId() == QubitTerm::PUBLICATION_ID ||
           $this->getId() == QubitTerm::CONTRIBUTION_ID ||
           $this->getId() == QubitTerm::TITLE_NOTE_ID ||
           $this->getId() == QubitTerm::PUBLICATION_NOTE_ID ||
           $this->getId() == QubitTerm::ARCHIVAL_MATERIAL_ID ||
           $this->getId() == QubitTerm::FINDING_AIDS_ID ||
           $this->getId() == QubitTerm::PUBLISHED_MATERIAL_ID ||
           $this->getId() == QubitTerm::ARTEFACT_MATERIAL_ID ||
           $this->getId() == QubitTerm::CORPORATE_BODY_ID ||
           $this->getId() == QubitTerm::PERSON_ID ||
           $this->getId() == QubitTerm::FAMILY_ID ||
           $this->getId() == QubitTerm::FAMILY_NAME_FIRST_NAME_ID ||
           $this->getId() == QubitTerm::AUDIO_ID ||
           $this->getId() == QubitTerm::IMAGE_ID ||
           $this->getId() == QubitTerm::TEXT_ID ||
           $this->getId() == QubitTerm::VIDEO_ID ||
           $this->getId() == QubitTerm::OTHER_ID ||
           $this->getId() == QubitTerm::MASTER_ID ||
           $this->getId() == QubitTerm::REFERENCE_ID ||
           $this->getId() == QubitTerm::THUMBNAIL_ID ||
           $this->getId() == QubitTerm::LOCATION_ID ||
           $this->getId() == QubitTerm::CONTAINER_ID ||
           $this->getId() == QubitTerm::ARTEFACT_ID ||
           $this->getId() == QubitTerm::HAS_PHYSICAL_OBJECT_ID;
  }
  
  
  public function __toString()
  {
    if (!$this->getName())
      {
      return (string) $this->getName(array('sourceCulture' => true));
      }
  
    return (string) $this->getName();
  }

  public static function getLevelsOfDescription($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID, $options);
  }

  public static function getNoteTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::NOTE_TYPE_ID, $options);
  }

  public static function getSubjects($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::SUBJECT_ID, $options);
  }

  public static function getPlaces($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::PLACE_ID, $options);
  }

  public static function getActorEntityTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_ENTITY_TYPE_ID, $options);
  }

  public static function getActorNameTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_NAME_TYPE_ID, $options);
  }

  public static function getDescriptionStatuses($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID, $options);
  }

  public static function getDescriptionDetailLevels($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID, $options);
  }

  public static function getRepositoryTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::REPOSITORY_TYPE_ID, $options);
  }

  public static function getActorRoles($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_ROLE_ID, $options);
  }

  public static function getEventTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::EVENT_TYPE_ID, $options);
  }

  public static function getMediaTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::MEDIA_TYPE_ID, $options);
  }

  public static function getUsageTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::DIGITAL_OBJECT_USAGE_ID, $options);
  }
  
  
  /**
   * Return a list of all Physical Object terms
   *
   * @param array $options  option array to pass to Qubit Query object
   * @return QubitQuery array of Physical Object QubitTerm objects
   */
  public static function getPhysicalObjectTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::PHYSICAL_OBJECT_TYPE_ID, $options);
  }
  
  
  /**
   * Return a list of all Relation Type terms
   *
   * @param array $options  option array to pass to Qubit Query object
   * @return QubitQuery object
   */
  public static function getRelationTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::RELATION_TYPE_ID, $options);
  }
  
  
  /**
   * Return a list of all Physical object container types
   *
   * @return QubitQuery array of container QubitTerm objects
   */
  public static function getPhysicalObjectContainerTypes()
  {
    $containerTerm = QubitTerm::getById(QubitTerm::CONTAINER_ID);
    return $containerTerm->getDescendants();
  }
  
  
  /**
   * Get a list of child terms of $parentTermId. Prefix $indentStr * depth of child
   * relative to parent
   *
   * @param integer $parentTermId  Primary key of parent term
   * @param string  $indentStr     String to prefix to each sub-level for indenting
   * 
   * @return mixed  false on failure, else array of children formatted for select box
   */
  public static function getIndentedChildTree($parentTermId, $indentStr="&nbsp;")
  {
    if (!$parentTerm = QubitTerm::getById($parentTermId)) 
    {

      return false;
    }
    
    $parentDepth = count($parentTerm->getAncestors());
    
    foreach ($parentTerm->getDescendants()->orderBy('lft') as $i => $node)
    {
      $relativeDepth = intval(count($node->getAncestors()) - $parentDepth - 1);
      $tree[$node->getId()] = str_repeat($indentStr, $relativeDepth).$node->getName(array('cultureFallback' => 'true'));
    }
    
    return $tree;
  }
  

  
  protected $CountryHitCount = null;
  protected $LanguageHitCount = null;
  protected $SubjectHitCount = null;
  
  public function setCountryHitCount($count)
  {
    $this->CountryHitCount = $count;
  }
  
  public function getCountryHitCount()
  {
    return $this->CountryHitCount;
  }
  
  public function setLanguageHitCount($count)
  {
    $this->LanguageHitCount = $count;
  }
  
  public function getLanguageHitCount()
  {
    return $this->LanguageHitCount;
  }
  
  public function setSubjectHitCount($count)
  {
    $this->SubjectHitCount = $count;
  }
  
  public function getSubjectHitCount()
  {
    return $this->SubjectHitCount;
  }

}



