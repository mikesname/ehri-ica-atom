<?php

abstract class BaseTerm extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_term',

    ID = 'q_term.ID',
    TAXONOMY_ID = 'q_term.TAXONOMY_ID',
    CODE = 'q_term.CODE',
    PARENT_ID = 'q_term.PARENT_ID',
    LFT = 'q_term.LFT',
    RGT = 'q_term.RGT',
    CREATED_AT = 'q_term.CREATED_AT',
    UPDATED_AT = 'q_term.UPDATED_AT',
    SOURCE_CULTURE = 'q_term.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitTerm::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitTerm::ID);
    $criteria->addSelectColumn(QubitTerm::TAXONOMY_ID);
    $criteria->addSelectColumn(QubitTerm::CODE);
    $criteria->addSelectColumn(QubitTerm::PARENT_ID);
    $criteria->addSelectColumn(QubitTerm::LFT);
    $criteria->addSelectColumn(QubitTerm::RGT);
    $criteria->addSelectColumn(QubitTerm::CREATED_AT);
    $criteria->addSelectColumn(QubitTerm::UPDATED_AT);
    $criteria->addSelectColumn(QubitTerm::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTerm::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitTerm', $options);
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
    $criteria->add(QubitTerm::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitTerm::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitTerm::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitTerm::PARENT_ID);

    return $criteria;
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitTerm::DATABASE_NAME)->getTable(QubitTerm::TABLE_NAME);
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

    if (call_user_func_array(array($this->getCurrenttermI18n($options), '__isset'), $args))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && call_user_func_array(array($this->getCurrenttermI18n(array('sourceCulture' => true) + $options), '__isset'), $args))
    {
      return true;
    }

    if ('ancestors' == $name)
    {
      return true;
    }

    if ('descendants' == $name)
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

    if (null !== $value = call_user_func_array(array($this->getCurrenttermI18n($options), '__get'), $args))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = call_user_func_array(array($this->getCurrenttermI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = call_user_func_array(array($this->getCurrenttermI18n(array('sourceCulture' => true) + $options), '__get'), $args))
    {
      return $value;
    }

    if ('ancestors' == $name)
    {
      if (!isset($this->values['ancestors']))
      {
        if ($this->new)
        {
          $this->values['ancestors'] = QubitQuery::create(array('self' => $this) + $options);
        }
        else
        {
          $criteria = new Criteria;
          $this->addAncestorsCriteria($criteria);
          $this->addOrderByPreorder($criteria);
          $this->values['ancestors'] = self::get($criteria, array('self' => $this) + $options);
        }
      }

      return $this->values['ancestors'];
    }

    if ('descendants' == $name)
    {
      if (!isset($this->values['descendants']))
      {
        if ($this->new)
        {
          $this->values['descendants'] = QubitQuery::create(array('self' => $this) + $options);
        }
        else
        {
          $criteria = new Criteria;
          $this->addDescendantsCriteria($criteria);
          $this->addOrderByPreorder($criteria);
          $this->values['descendants'] = self::get($criteria, array('self' => $this) + $options);
        }
      }

      return $this->values['descendants'];
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

    call_user_func_array(array($this->getCurrenttermI18n($options), '__set'), $args);

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

    call_user_func_array(array($this->getCurrenttermI18n($options), '__unset'), $args);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->termI18ns as $termI18n)
    {
      $termI18n->setid($this->id);

      $affectedRows += $termI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $this->updateNestedSet($connection);

    $affectedRows += parent::insert($connection);

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    // Update nested set keys only if parent id has changed
    if (isset($this->values['parentId']))
    {
      // Get the "original" parentId before any updates
      $offset = 0; 
      $originalParentId = null;
      foreach ($this->tables as $table)
      {
        foreach ($table->getColumns() as $column)
        {
          if ('parentId' == $column->getPhpName())
          {
            $originalParentId = $this->row[$offset];
            break;
          }
          $offset++;
        }
      }
      
      // If updated value of parentId is different then original value,
      // update the nested set
      if ($originalParentId != $this->values['parentId'])
      {
        $this->updateNestedSet($connection);
      }
    }

    $affectedRows += parent::update($connection);

    return $affectedRows;
  }

  public function delete($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('This object has already been deleted.');
    }

    $affectedRows = 0;

    $this->refresh(array('connection' => $connection));
    $this->deleteFromNestedSet($connection);

    $affectedRows += parent::delete($connection);

    return $affectedRows;
  }

  public static function addJointaxonomyCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitTerm::TAXONOMY_ID, QubitTaxonomy::ID);

    return $criteria;
  }

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitTerm::PARENT_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addactorsRelatedByentityTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::ENTITY_TYPE_ID, $id);

    return $criteria;
  }

  public static function getactorsRelatedByentityTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addactorsRelatedByentityTypeIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addactorsRelatedByentityTypeIdCriteria(Criteria $criteria)
  {
    return self::addactorsRelatedByentityTypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $actorsRelatedByentityTypeId = null;

  public function getactorsRelatedByentityTypeId(array $options = array())
  {
    if (!isset($this->actorsRelatedByentityTypeId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedByentityTypeId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedByentityTypeId = self::getactorsRelatedByentityTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedByentityTypeId;
  }

  public static function addactorsRelatedBydescriptionStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::DESCRIPTION_STATUS_ID, $id);

    return $criteria;
  }

  public static function getactorsRelatedBydescriptionStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addactorsRelatedBydescriptionStatusIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addactorsRelatedBydescriptionStatusIdCriteria(Criteria $criteria)
  {
    return self::addactorsRelatedBydescriptionStatusIdCriteriaById($criteria, $this->id);
  }

  protected
    $actorsRelatedBydescriptionStatusId = null;

  public function getactorsRelatedBydescriptionStatusId(array $options = array())
  {
    if (!isset($this->actorsRelatedBydescriptionStatusId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedBydescriptionStatusId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedBydescriptionStatusId = self::getactorsRelatedBydescriptionStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedBydescriptionStatusId;
  }

  public static function addactorsRelatedBydescriptionDetailIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::DESCRIPTION_DETAIL_ID, $id);

    return $criteria;
  }

  public static function getactorsRelatedBydescriptionDetailIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addactorsRelatedBydescriptionDetailIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addactorsRelatedBydescriptionDetailIdCriteria(Criteria $criteria)
  {
    return self::addactorsRelatedBydescriptionDetailIdCriteriaById($criteria, $this->id);
  }

  protected
    $actorsRelatedBydescriptionDetailId = null;

  public function getactorsRelatedBydescriptionDetailId(array $options = array())
  {
    if (!isset($this->actorsRelatedBydescriptionDetailId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedBydescriptionDetailId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedBydescriptionDetailId = self::getactorsRelatedBydescriptionDetailIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedBydescriptionDetailId;
  }

  public static function addactorNamesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActorName::TYPE_ID, $id);

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

  public static function adddigitalObjectsRelatedByusageIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::USAGE_ID, $id);

    return $criteria;
  }

  public static function getdigitalObjectsRelatedByusageIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::adddigitalObjectsRelatedByusageIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function adddigitalObjectsRelatedByusageIdCriteria(Criteria $criteria)
  {
    return self::adddigitalObjectsRelatedByusageIdCriteriaById($criteria, $this->id);
  }

  protected
    $digitalObjectsRelatedByusageId = null;

  public function getdigitalObjectsRelatedByusageId(array $options = array())
  {
    if (!isset($this->digitalObjectsRelatedByusageId))
    {
      if (!isset($this->id))
      {
        $this->digitalObjectsRelatedByusageId = QubitQuery::create();
      }
      else
      {
        $this->digitalObjectsRelatedByusageId = self::getdigitalObjectsRelatedByusageIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjectsRelatedByusageId;
  }

  public static function adddigitalObjectsRelatedBymediaTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::MEDIA_TYPE_ID, $id);

    return $criteria;
  }

  public static function getdigitalObjectsRelatedBymediaTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::adddigitalObjectsRelatedBymediaTypeIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function adddigitalObjectsRelatedBymediaTypeIdCriteria(Criteria $criteria)
  {
    return self::adddigitalObjectsRelatedBymediaTypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $digitalObjectsRelatedBymediaTypeId = null;

  public function getdigitalObjectsRelatedBymediaTypeId(array $options = array())
  {
    if (!isset($this->digitalObjectsRelatedBymediaTypeId))
    {
      if (!isset($this->id))
      {
        $this->digitalObjectsRelatedBymediaTypeId = QubitQuery::create();
      }
      else
      {
        $this->digitalObjectsRelatedBymediaTypeId = self::getdigitalObjectsRelatedBymediaTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjectsRelatedBymediaTypeId;
  }

  public static function adddigitalObjectsRelatedBychecksumTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::CHECKSUM_TYPE_ID, $id);

    return $criteria;
  }

  public static function getdigitalObjectsRelatedBychecksumTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::adddigitalObjectsRelatedBychecksumTypeIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function adddigitalObjectsRelatedBychecksumTypeIdCriteria(Criteria $criteria)
  {
    return self::adddigitalObjectsRelatedBychecksumTypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $digitalObjectsRelatedBychecksumTypeId = null;

  public function getdigitalObjectsRelatedBychecksumTypeId(array $options = array())
  {
    if (!isset($this->digitalObjectsRelatedBychecksumTypeId))
    {
      if (!isset($this->id))
      {
        $this->digitalObjectsRelatedBychecksumTypeId = QubitQuery::create();
      }
      else
      {
        $this->digitalObjectsRelatedBychecksumTypeId = self::getdigitalObjectsRelatedBychecksumTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjectsRelatedBychecksumTypeId;
  }

  public static function addeventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEvent::TYPE_ID, $id);

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

  public static function addfunctionsRelatedBytypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunction::TYPE_ID, $id);

    return $criteria;
  }

  public static function getfunctionsRelatedBytypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addfunctionsRelatedBytypeIdCriteriaById($criteria, $id);

    return QubitFunction::get($criteria, $options);
  }

  public function addfunctionsRelatedBytypeIdCriteria(Criteria $criteria)
  {
    return self::addfunctionsRelatedBytypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $functionsRelatedBytypeId = null;

  public function getfunctionsRelatedBytypeId(array $options = array())
  {
    if (!isset($this->functionsRelatedBytypeId))
    {
      if (!isset($this->id))
      {
        $this->functionsRelatedBytypeId = QubitQuery::create();
      }
      else
      {
        $this->functionsRelatedBytypeId = self::getfunctionsRelatedBytypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionsRelatedBytypeId;
  }

  public static function addfunctionsRelatedBydescriptionStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunction::DESCRIPTION_STATUS_ID, $id);

    return $criteria;
  }

  public static function getfunctionsRelatedBydescriptionStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addfunctionsRelatedBydescriptionStatusIdCriteriaById($criteria, $id);

    return QubitFunction::get($criteria, $options);
  }

  public function addfunctionsRelatedBydescriptionStatusIdCriteria(Criteria $criteria)
  {
    return self::addfunctionsRelatedBydescriptionStatusIdCriteriaById($criteria, $this->id);
  }

  protected
    $functionsRelatedBydescriptionStatusId = null;

  public function getfunctionsRelatedBydescriptionStatusId(array $options = array())
  {
    if (!isset($this->functionsRelatedBydescriptionStatusId))
    {
      if (!isset($this->id))
      {
        $this->functionsRelatedBydescriptionStatusId = QubitQuery::create();
      }
      else
      {
        $this->functionsRelatedBydescriptionStatusId = self::getfunctionsRelatedBydescriptionStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionsRelatedBydescriptionStatusId;
  }

  public static function addfunctionsRelatedBydescriptionLevelIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunction::DESCRIPTION_LEVEL_ID, $id);

    return $criteria;
  }

  public static function getfunctionsRelatedBydescriptionLevelIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addfunctionsRelatedBydescriptionLevelIdCriteriaById($criteria, $id);

    return QubitFunction::get($criteria, $options);
  }

  public function addfunctionsRelatedBydescriptionLevelIdCriteria(Criteria $criteria)
  {
    return self::addfunctionsRelatedBydescriptionLevelIdCriteriaById($criteria, $this->id);
  }

  protected
    $functionsRelatedBydescriptionLevelId = null;

  public function getfunctionsRelatedBydescriptionLevelId(array $options = array())
  {
    if (!isset($this->functionsRelatedBydescriptionLevelId))
    {
      if (!isset($this->id))
      {
        $this->functionsRelatedBydescriptionLevelId = QubitQuery::create();
      }
      else
      {
        $this->functionsRelatedBydescriptionLevelId = self::getfunctionsRelatedBydescriptionLevelIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionsRelatedBydescriptionLevelId;
  }

  public static function addhistoricalEventsRelatedBytypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitHistoricalEvent::TYPE_ID, $id);

    return $criteria;
  }

  public static function gethistoricalEventsRelatedBytypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addhistoricalEventsRelatedBytypeIdCriteriaById($criteria, $id);

    return QubitHistoricalEvent::get($criteria, $options);
  }

  public function addhistoricalEventsRelatedBytypeIdCriteria(Criteria $criteria)
  {
    return self::addhistoricalEventsRelatedBytypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $historicalEventsRelatedBytypeId = null;

  public function gethistoricalEventsRelatedBytypeId(array $options = array())
  {
    if (!isset($this->historicalEventsRelatedBytypeId))
    {
      if (!isset($this->id))
      {
        $this->historicalEventsRelatedBytypeId = QubitQuery::create();
      }
      else
      {
        $this->historicalEventsRelatedBytypeId = self::gethistoricalEventsRelatedBytypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->historicalEventsRelatedBytypeId;
  }

  public static function addinformationObjectsRelatedBylevelOfDescriptionIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::LEVEL_OF_DESCRIPTION_ID, $id);

    return $criteria;
  }

  public static function getinformationObjectsRelatedBylevelOfDescriptionIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addinformationObjectsRelatedBylevelOfDescriptionIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addinformationObjectsRelatedBylevelOfDescriptionIdCriteria(Criteria $criteria)
  {
    return self::addinformationObjectsRelatedBylevelOfDescriptionIdCriteriaById($criteria, $this->id);
  }

  protected
    $informationObjectsRelatedBylevelOfDescriptionId = null;

  public function getinformationObjectsRelatedBylevelOfDescriptionId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedBylevelOfDescriptionId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedBylevelOfDescriptionId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedBylevelOfDescriptionId = self::getinformationObjectsRelatedBylevelOfDescriptionIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedBylevelOfDescriptionId;
  }

  public static function addinformationObjectsRelatedBycollectionTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::COLLECTION_TYPE_ID, $id);

    return $criteria;
  }

  public static function getinformationObjectsRelatedBycollectionTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addinformationObjectsRelatedBycollectionTypeIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addinformationObjectsRelatedBycollectionTypeIdCriteria(Criteria $criteria)
  {
    return self::addinformationObjectsRelatedBycollectionTypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $informationObjectsRelatedBycollectionTypeId = null;

  public function getinformationObjectsRelatedBycollectionTypeId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedBycollectionTypeId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedBycollectionTypeId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedBycollectionTypeId = self::getinformationObjectsRelatedBycollectionTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedBycollectionTypeId;
  }

  public static function addinformationObjectsRelatedBydescriptionStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::DESCRIPTION_STATUS_ID, $id);

    return $criteria;
  }

  public static function getinformationObjectsRelatedBydescriptionStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addinformationObjectsRelatedBydescriptionStatusIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addinformationObjectsRelatedBydescriptionStatusIdCriteria(Criteria $criteria)
  {
    return self::addinformationObjectsRelatedBydescriptionStatusIdCriteriaById($criteria, $this->id);
  }

  protected
    $informationObjectsRelatedBydescriptionStatusId = null;

  public function getinformationObjectsRelatedBydescriptionStatusId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedBydescriptionStatusId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedBydescriptionStatusId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedBydescriptionStatusId = self::getinformationObjectsRelatedBydescriptionStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedBydescriptionStatusId;
  }

  public static function addinformationObjectsRelatedBydescriptionDetailIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::DESCRIPTION_DETAIL_ID, $id);

    return $criteria;
  }

  public static function getinformationObjectsRelatedBydescriptionDetailIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addinformationObjectsRelatedBydescriptionDetailIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addinformationObjectsRelatedBydescriptionDetailIdCriteria(Criteria $criteria)
  {
    return self::addinformationObjectsRelatedBydescriptionDetailIdCriteriaById($criteria, $this->id);
  }

  protected
    $informationObjectsRelatedBydescriptionDetailId = null;

  public function getinformationObjectsRelatedBydescriptionDetailId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedBydescriptionDetailId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedBydescriptionDetailId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedBydescriptionDetailId = self::getinformationObjectsRelatedBydescriptionDetailIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedBydescriptionDetailId;
  }

  public static function addnotesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::TYPE_ID, $id);

    return $criteria;
  }

  public static function getnotesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addnotesCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addnotesCriteria(Criteria $criteria)
  {
    return self::addnotesCriteriaById($criteria, $this->id);
  }

  protected
    $notes = null;

  public function getnotes(array $options = array())
  {
    if (!isset($this->notes))
    {
      if (!isset($this->id))
      {
        $this->notes = QubitQuery::create();
      }
      else
      {
        $this->notes = self::getnotesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notes;
  }

  public static function addobjectTermRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitObjectTermRelation::TERM_ID, $id);

    return $criteria;
  }

  public static function getobjectTermRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addobjectTermRelationsCriteriaById($criteria, $id);

    return QubitObjectTermRelation::get($criteria, $options);
  }

  public function addobjectTermRelationsCriteria(Criteria $criteria)
  {
    return self::addobjectTermRelationsCriteriaById($criteria, $this->id);
  }

  protected
    $objectTermRelations = null;

  public function getobjectTermRelations(array $options = array())
  {
    if (!isset($this->objectTermRelations))
    {
      if (!isset($this->id))
      {
        $this->objectTermRelations = QubitQuery::create();
      }
      else
      {
        $this->objectTermRelations = self::getobjectTermRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->objectTermRelations;
  }

  public static function addphysicalObjectsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPhysicalObject::TYPE_ID, $id);

    return $criteria;
  }

  public static function getphysicalObjectsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addphysicalObjectsCriteriaById($criteria, $id);

    return QubitPhysicalObject::get($criteria, $options);
  }

  public function addphysicalObjectsCriteria(Criteria $criteria)
  {
    return self::addphysicalObjectsCriteriaById($criteria, $this->id);
  }

  protected
    $physicalObjects = null;

  public function getphysicalObjects(array $options = array())
  {
    if (!isset($this->physicalObjects))
    {
      if (!isset($this->id))
      {
        $this->physicalObjects = QubitQuery::create();
      }
      else
      {
        $this->physicalObjects = self::getphysicalObjectsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->physicalObjects;
  }

  public static function addplacesRelatedBycountryIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlace::COUNTRY_ID, $id);

    return $criteria;
  }

  public static function getplacesRelatedBycountryIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addplacesRelatedBycountryIdCriteriaById($criteria, $id);

    return QubitPlace::get($criteria, $options);
  }

  public function addplacesRelatedBycountryIdCriteria(Criteria $criteria)
  {
    return self::addplacesRelatedBycountryIdCriteriaById($criteria, $this->id);
  }

  protected
    $placesRelatedBycountryId = null;

  public function getplacesRelatedBycountryId(array $options = array())
  {
    if (!isset($this->placesRelatedBycountryId))
    {
      if (!isset($this->id))
      {
        $this->placesRelatedBycountryId = QubitQuery::create();
      }
      else
      {
        $this->placesRelatedBycountryId = self::getplacesRelatedBycountryIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placesRelatedBycountryId;
  }

  public static function addplacesRelatedBytypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlace::TYPE_ID, $id);

    return $criteria;
  }

  public static function getplacesRelatedBytypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addplacesRelatedBytypeIdCriteriaById($criteria, $id);

    return QubitPlace::get($criteria, $options);
  }

  public function addplacesRelatedBytypeIdCriteria(Criteria $criteria)
  {
    return self::addplacesRelatedBytypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $placesRelatedBytypeId = null;

  public function getplacesRelatedBytypeId(array $options = array())
  {
    if (!isset($this->placesRelatedBytypeId))
    {
      if (!isset($this->id))
      {
        $this->placesRelatedBytypeId = QubitQuery::create();
      }
      else
      {
        $this->placesRelatedBytypeId = self::getplacesRelatedBytypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placesRelatedBytypeId;
  }

  public static function addplaceMapRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceMapRelation::TYPE_ID, $id);

    return $criteria;
  }

  public static function getplaceMapRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addplaceMapRelationsCriteriaById($criteria, $id);

    return QubitPlaceMapRelation::get($criteria, $options);
  }

  public function addplaceMapRelationsCriteria(Criteria $criteria)
  {
    return self::addplaceMapRelationsCriteriaById($criteria, $this->id);
  }

  protected
    $placeMapRelations = null;

  public function getplaceMapRelations(array $options = array())
  {
    if (!isset($this->placeMapRelations))
    {
      if (!isset($this->id))
      {
        $this->placeMapRelations = QubitQuery::create();
      }
      else
      {
        $this->placeMapRelations = self::getplaceMapRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placeMapRelations;
  }

  public static function addrightssCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRights::PERMISSION_ID, $id);

    return $criteria;
  }

  public static function getrightssById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightssCriteriaById($criteria, $id);

    return QubitRights::get($criteria, $options);
  }

  public function addrightssCriteria(Criteria $criteria)
  {
    return self::addrightssCriteriaById($criteria, $this->id);
  }

  protected
    $rightss = null;

  public function getrightss(array $options = array())
  {
    if (!isset($this->rightss))
    {
      if (!isset($this->id))
      {
        $this->rightss = QubitQuery::create();
      }
      else
      {
        $this->rightss = self::getrightssById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightss;
  }

  public static function addrelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRelation::TYPE_ID, $id);

    return $criteria;
  }

  public static function getrelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrelationsCriteriaById($criteria, $id);

    return QubitRelation::get($criteria, $options);
  }

  public function addrelationsCriteria(Criteria $criteria)
  {
    return self::addrelationsCriteriaById($criteria, $this->id);
  }

  protected
    $relations = null;

  public function getrelations(array $options = array())
  {
    if (!isset($this->relations))
    {
      if (!isset($this->id))
      {
        $this->relations = QubitQuery::create();
      }
      else
      {
        $this->relations = self::getrelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->relations;
  }

  public static function addrepositorysRelatedBytypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepository::TYPE_ID, $id);

    return $criteria;
  }

  public static function getrepositorysRelatedBytypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrepositorysRelatedBytypeIdCriteriaById($criteria, $id);

    return QubitRepository::get($criteria, $options);
  }

  public function addrepositorysRelatedBytypeIdCriteria(Criteria $criteria)
  {
    return self::addrepositorysRelatedBytypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $repositorysRelatedBytypeId = null;

  public function getrepositorysRelatedBytypeId(array $options = array())
  {
    if (!isset($this->repositorysRelatedBytypeId))
    {
      if (!isset($this->id))
      {
        $this->repositorysRelatedBytypeId = QubitQuery::create();
      }
      else
      {
        $this->repositorysRelatedBytypeId = self::getrepositorysRelatedBytypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositorysRelatedBytypeId;
  }

  public static function addrepositorysRelatedBydescStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepository::DESC_STATUS_ID, $id);

    return $criteria;
  }

  public static function getrepositorysRelatedBydescStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrepositorysRelatedBydescStatusIdCriteriaById($criteria, $id);

    return QubitRepository::get($criteria, $options);
  }

  public function addrepositorysRelatedBydescStatusIdCriteria(Criteria $criteria)
  {
    return self::addrepositorysRelatedBydescStatusIdCriteriaById($criteria, $this->id);
  }

  protected
    $repositorysRelatedBydescStatusId = null;

  public function getrepositorysRelatedBydescStatusId(array $options = array())
  {
    if (!isset($this->repositorysRelatedBydescStatusId))
    {
      if (!isset($this->id))
      {
        $this->repositorysRelatedBydescStatusId = QubitQuery::create();
      }
      else
      {
        $this->repositorysRelatedBydescStatusId = self::getrepositorysRelatedBydescStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositorysRelatedBydescStatusId;
  }

  public static function addrepositorysRelatedBydescDetailIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepository::DESC_DETAIL_ID, $id);

    return $criteria;
  }

  public static function getrepositorysRelatedBydescDetailIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrepositorysRelatedBydescDetailIdCriteriaById($criteria, $id);

    return QubitRepository::get($criteria, $options);
  }

  public function addrepositorysRelatedBydescDetailIdCriteria(Criteria $criteria)
  {
    return self::addrepositorysRelatedBydescDetailIdCriteriaById($criteria, $this->id);
  }

  protected
    $repositorysRelatedBydescDetailId = null;

  public function getrepositorysRelatedBydescDetailId(array $options = array())
  {
    if (!isset($this->repositorysRelatedBydescDetailId))
    {
      if (!isset($this->id))
      {
        $this->repositorysRelatedBydescDetailId = QubitQuery::create();
      }
      else
      {
        $this->repositorysRelatedBydescDetailId = self::getrepositorysRelatedBydescDetailIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositorysRelatedBydescDetailId;
  }

  public static function addrightsActorRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsActorRelation::TYPE_ID, $id);

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

  public static function addrightsTermRelationsRelatedBytermIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsTermRelation::TERM_ID, $id);

    return $criteria;
  }

  public static function getrightsTermRelationsRelatedBytermIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightsTermRelationsRelatedBytermIdCriteriaById($criteria, $id);

    return QubitRightsTermRelation::get($criteria, $options);
  }

  public function addrightsTermRelationsRelatedBytermIdCriteria(Criteria $criteria)
  {
    return self::addrightsTermRelationsRelatedBytermIdCriteriaById($criteria, $this->id);
  }

  protected
    $rightsTermRelationsRelatedBytermId = null;

  public function getrightsTermRelationsRelatedBytermId(array $options = array())
  {
    if (!isset($this->rightsTermRelationsRelatedBytermId))
    {
      if (!isset($this->id))
      {
        $this->rightsTermRelationsRelatedBytermId = QubitQuery::create();
      }
      else
      {
        $this->rightsTermRelationsRelatedBytermId = self::getrightsTermRelationsRelatedBytermIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsTermRelationsRelatedBytermId;
  }

  public static function addrightsTermRelationsRelatedBytypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsTermRelation::TYPE_ID, $id);

    return $criteria;
  }

  public static function getrightsTermRelationsRelatedBytypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightsTermRelationsRelatedBytypeIdCriteriaById($criteria, $id);

    return QubitRightsTermRelation::get($criteria, $options);
  }

  public function addrightsTermRelationsRelatedBytypeIdCriteria(Criteria $criteria)
  {
    return self::addrightsTermRelationsRelatedBytypeIdCriteriaById($criteria, $this->id);
  }

  protected
    $rightsTermRelationsRelatedBytypeId = null;

  public function getrightsTermRelationsRelatedBytypeId(array $options = array())
  {
    if (!isset($this->rightsTermRelationsRelatedBytypeId))
    {
      if (!isset($this->id))
      {
        $this->rightsTermRelationsRelatedBytypeId = QubitQuery::create();
      }
      else
      {
        $this->rightsTermRelationsRelatedBytypeId = self::getrightsTermRelationsRelatedBytypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsTermRelationsRelatedBytypeId;
  }

  public static function addsystemEventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitSystemEvent::TYPE_ID, $id);

    return $criteria;
  }

  public static function getsystemEventsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addsystemEventsCriteriaById($criteria, $id);

    return QubitSystemEvent::get($criteria, $options);
  }

  public function addsystemEventsCriteria(Criteria $criteria)
  {
    return self::addsystemEventsCriteriaById($criteria, $this->id);
  }

  protected
    $systemEvents = null;

  public function getsystemEvents(array $options = array())
  {
    if (!isset($this->systemEvents))
    {
      if (!isset($this->id))
      {
        $this->systemEvents = QubitQuery::create();
      }
      else
      {
        $this->systemEvents = self::getsystemEventsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->systemEvents;
  }

  public static function addtermsRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitTerm::PARENT_ID, $id);

    return $criteria;
  }

  public static function gettermsRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addtermsRelatedByparentIdCriteriaById($criteria, $id);

    return QubitTerm::get($criteria, $options);
  }

  public function addtermsRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::addtermsRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  protected
    $termsRelatedByparentId = null;

  public function gettermsRelatedByparentId(array $options = array())
  {
    if (!isset($this->termsRelatedByparentId))
    {
      if (!isset($this->id))
      {
        $this->termsRelatedByparentId = QubitQuery::create();
      }
      else
      {
        $this->termsRelatedByparentId = self::gettermsRelatedByparentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->termsRelatedByparentId;
  }

  public static function addtermI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitTermI18n::ID, $id);

    return $criteria;
  }

  public static function gettermI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addtermI18nsCriteriaById($criteria, $id);

    return QubitTermI18n::get($criteria, $options);
  }

  public function addtermI18nsCriteria(Criteria $criteria)
  {
    return self::addtermI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $termI18ns = null;

  public function gettermI18ns(array $options = array())
  {
    if (!isset($this->termI18ns))
    {
      if (!isset($this->id))
      {
        $this->termI18ns = QubitQuery::create();
      }
      else
      {
        $this->termI18ns = self::gettermI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->termI18ns;
  }

  public function getCurrenttermI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->termI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $termI18n = QubitTermI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $termI18n = new QubitTermI18n;
        $termI18n->setculture($options['culture']);
      }
      $this->termI18ns[$options['culture']] = $termI18n;
    }

    return $this->termI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitTerm::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitTerm::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitTerm::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitTerm::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected function updateNestedSet($connection = null)
  {
unset($this->values['lft']);
unset($this->values['rgt']);
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTerm::DATABASE_NAME);
    }

    if (!isset($this->lft) || !isset($this->rgt))
    {
      $delta = 2;
    }
    else
    {
      $delta = $this->rgt - $this->lft + 1;
    }

    if (null === $parent = $this->__get('parent', array('connection' => $connection)))
    {
      $statement = $connection->prepare('
        SELECT MAX('.QubitTerm::RGT.')
        FROM '.QubitTerm::TABLE_NAME);
      $statement->execute();
      $row = $statement->fetch();
      $max = $row[0];

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $this->lft = $max + 1;
        $this->rgt = $max + 2;

        return $this;
      }

      $shift = $max + 1 - $this->lft;
    }
    else
    {
      $parent->refresh(array('connection' => $connection));

      if (isset($this->lft) && isset($this->rgt) && $this->lft <= $parent->lft && $this->rgt >= $parent->rgt)
      {
        throw new PropelException('An object cannot be a descendant of itself.');
      }

      $statement = $connection->prepare('
        UPDATE '.QubitTerm::TABLE_NAME.'
        SET '.QubitTerm::LFT.' = '.QubitTerm::LFT.' + ?
        WHERE '.QubitTerm::LFT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      $statement = $connection->prepare('
        UPDATE '.QubitTerm::TABLE_NAME.'
        SET '.QubitTerm::RGT.' = '.QubitTerm::RGT.' + ?
        WHERE '.QubitTerm::RGT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $this->lft = $parent->rgt;
        $this->rgt = $parent->rgt + 1;

        return $this;
      }

      if ($this->lft > $parent->rgt)
      {
        $this->lft += $delta;
        $this->rgt += $delta;
      }

      $shift = $parent->rgt - $this->lft;
    }

    $statement = $connection->prepare('
      UPDATE '.QubitTerm::TABLE_NAME.'
      SET '.QubitTerm::LFT.' = '.QubitTerm::LFT.' + ?, '.QubitTerm::RGT.' = '.QubitTerm::RGT.' + ?
      WHERE '.QubitTerm::LFT.' >= ?
      AND '.QubitTerm::RGT.' <= ?');
    $statement->execute(array($shift, $shift, $this->lft, $this->rgt));

    $this->deleteFromNestedSet($connection);

    if ($shift > 0)
    {
      $this->lft -= $delta;
      $this->rgt -= $delta;
    }

    $this->lft += $shift;
    $this->rgt += $shift;

    return $this;
  }

  protected function deleteFromNestedSet($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTerm::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $statement = $connection->prepare('
      UPDATE '.QubitTerm::TABLE_NAME.'
      SET '.QubitTerm::LFT.' = '.QubitTerm::LFT.' - ?
      WHERE '.QubitTerm::LFT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    $statement = $connection->prepare('
      UPDATE '.QubitTerm::TABLE_NAME.'
      SET '.QubitTerm::RGT.' = '.QubitTerm::RGT.' - ?
      WHERE '.QubitTerm::RGT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    return $this;
  }
}
