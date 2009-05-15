<?php

abstract class BaseActor extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_actor',

    ID = 'q_actor.ID',
    CORPORATE_BODY_IDENTIFIERS = 'q_actor.CORPORATE_BODY_IDENTIFIERS',
    ENTITY_TYPE_ID = 'q_actor.ENTITY_TYPE_ID',
    DESCRIPTION_STATUS_ID = 'q_actor.DESCRIPTION_STATUS_ID',
    DESCRIPTION_DETAIL_ID = 'q_actor.DESCRIPTION_DETAIL_ID',
    DESCRIPTION_IDENTIFIER = 'q_actor.DESCRIPTION_IDENTIFIER',
    PARENT_ID = 'q_actor.PARENT_ID',
    LFT = 'q_actor.LFT',
    RGT = 'q_actor.RGT',
    CREATED_AT = 'q_actor.CREATED_AT',
    UPDATED_AT = 'q_actor.UPDATED_AT',
    SOURCE_CULTURE = 'q_actor.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitActor::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitActor::ID);
    $criteria->addSelectColumn(QubitActor::CORPORATE_BODY_IDENTIFIERS);
    $criteria->addSelectColumn(QubitActor::ENTITY_TYPE_ID);
    $criteria->addSelectColumn(QubitActor::DESCRIPTION_STATUS_ID);
    $criteria->addSelectColumn(QubitActor::DESCRIPTION_DETAIL_ID);
    $criteria->addSelectColumn(QubitActor::DESCRIPTION_IDENTIFIER);
    $criteria->addSelectColumn(QubitActor::PARENT_ID);
    $criteria->addSelectColumn(QubitActor::LFT);
    $criteria->addSelectColumn(QubitActor::RGT);
    $criteria->addSelectColumn(QubitActor::CREATED_AT);
    $criteria->addSelectColumn(QubitActor::UPDATED_AT);
    $criteria->addSelectColumn(QubitActor::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitActor::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitActor', $options);
  }

  public static function getAll(array $options = array())
  {
    return self::get(new Criteria, $options);
  }

  public static function getOne(Criteria $criteria, array $options = array())
  {
    $criteria->setLimit(1);

    return self::get($criteria, $options)->__get(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitActor::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitActor::DATABASE_NAME)->getTable(QubitActor::TABLE_NAME);
  }

  public function __isset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    if (call_user_func_array(array($this, 'parent::__isset'), $args))
    {
      return true;
    }

    if (call_user_func_array(array($this->getCurrentactorI18n($options), '__isset'), $args))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && call_user_func_array(array($this->getCurrentactorI18n(array('sourceCulture' => true) + $options), '__isset'), $args))
    {
      return true;
    }

    return false;
  }

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    if (null !== $value = call_user_func_array(array($this, 'parent::__get'), $args))
    {
      return $value;
    }

    if (null !== $value = call_user_func_array(array($this->getCurrentactorI18n($options), '__get'), $args))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = call_user_func_array(array($this->getCurrentactorI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = call_user_func_array(array($this->getCurrentactorI18n(array('sourceCulture' => true) + $options), '__get'), $args))
    {
      return $value;
    }
  }

  public function __set($name, $value)
  {
    $args = func_get_args();

    $options = array();
    if (2 < count($args))
    {
      $options = $args[2];
    }

    call_user_func_array(array($this, 'parent::__set'), $args);

    call_user_func_array(array($this->getCurrentactorI18n($options), '__set'), $args);

    return $this;
  }

  public function __unset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    call_user_func_array(array($this, 'parent::__unset'), $args);

    call_user_func_array(array($this->getCurrentactorI18n($options), '__unset'), $args);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->actorI18ns as $actorI18n)
    {
      $actorI18n->setid($this->id);

      $affectedRows += $actorI18n->save($connection);
    }

    return $affectedRows;
  }

  public static function addJoinentityTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActor::ENTITY_TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoindescriptionStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActor::DESCRIPTION_STATUS_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoindescriptionDetailCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActor::DESCRIPTION_DETAIL_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActor::PARENT_ID, QubitActor::ID);

    return $criteria;
  }

  public static function addactorsRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::PARENT_ID, $id);

    return $criteria;
  }

  public static function getactorsRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addactorsRelatedByparentIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addactorsRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::addactorsRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  protected
    $actorsRelatedByparentId = null;

  public function getactorsRelatedByparentId(array $options = array())
  {
    if (!isset($this->actorsRelatedByparentId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedByparentId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedByparentId = self::getactorsRelatedByparentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedByparentId;
  }

  public static function addactorI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActorI18n::ID, $id);

    return $criteria;
  }

  public static function getactorI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addactorI18nsCriteriaById($criteria, $id);

    return QubitActorI18n::get($criteria, $options);
  }

  public function addactorI18nsCriteria(Criteria $criteria)
  {
    return self::addactorI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $actorI18ns = null;

  public function getactorI18ns(array $options = array())
  {
    if (!isset($this->actorI18ns))
    {
      if (!isset($this->id))
      {
        $this->actorI18ns = QubitQuery::create();
      }
      else
      {
        $this->actorI18ns = self::getactorI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorI18ns;
  }

  public static function addactorNamesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActorName::ACTOR_ID, $id);

    return $criteria;
  }

  public static function getactorNamesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addactorNamesCriteriaById($criteria, $id);

    return QubitActorName::get($criteria, $options);
  }

  public function addactorNamesCriteria(Criteria $criteria)
  {
    return self::addactorNamesCriteriaById($criteria, $this->id);
  }

  protected
    $actorNames = null;

  public function getactorNames(array $options = array())
  {
    if (!isset($this->actorNames))
    {
      if (!isset($this->id))
      {
        $this->actorNames = QubitQuery::create();
      }
      else
      {
        $this->actorNames = self::getactorNamesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorNames;
  }

  public static function addcontactInformationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitContactInformation::ACTOR_ID, $id);

    return $criteria;
  }

  public static function getcontactInformationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addcontactInformationsCriteriaById($criteria, $id);

    return QubitContactInformation::get($criteria, $options);
  }

  public function addcontactInformationsCriteria(Criteria $criteria)
  {
    return self::addcontactInformationsCriteriaById($criteria, $this->id);
  }

  protected
    $contactInformations = null;

  public function getcontactInformations(array $options = array())
  {
    if (!isset($this->contactInformations))
    {
      if (!isset($this->id))
      {
        $this->contactInformations = QubitQuery::create();
      }
      else
      {
        $this->contactInformations = self::getcontactInformationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->contactInformations;
  }

  public static function addeventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEvent::ACTOR_ID, $id);

    return $criteria;
  }

  public static function geteventsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addeventsCriteriaById($criteria, $id);

    return QubitEvent::get($criteria, $options);
  }

  public function addeventsCriteria(Criteria $criteria)
  {
    return self::addeventsCriteriaById($criteria, $this->id);
  }

  protected
    $events = null;

  public function getevents(array $options = array())
  {
    if (!isset($this->events))
    {
      if (!isset($this->id))
      {
        $this->events = QubitQuery::create();
      }
      else
      {
        $this->events = self::geteventsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->events;
  }

  public static function addrightsActorRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsActorRelation::ACTOR_ID, $id);

    return $criteria;
  }

  public static function getrightsActorRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightsActorRelationsCriteriaById($criteria, $id);

    return QubitRightsActorRelation::get($criteria, $options);
  }

  public function addrightsActorRelationsCriteria(Criteria $criteria)
  {
    return self::addrightsActorRelationsCriteriaById($criteria, $this->id);
  }

  protected
    $rightsActorRelations = null;

  public function getrightsActorRelations(array $options = array())
  {
    if (!isset($this->rightsActorRelations))
    {
      if (!isset($this->id))
      {
        $this->rightsActorRelations = QubitQuery::create();
      }
      else
      {
        $this->rightsActorRelations = self::getrightsActorRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsActorRelations;
  }

  public function getCurrentactorI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->actorI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $actorI18n = QubitActorI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $actorI18n = new QubitActorI18n;
        $actorI18n->setculture($options['culture']);
      }
      $this->actorI18ns[$options['culture']] = $actorI18n;
    }

    return $this->actorI18ns[$options['culture']];
  }
}
