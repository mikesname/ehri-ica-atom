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

    try
    {
      return call_user_func_array(array($this, 'QubitObject::__isset'), $args);
    }
    catch (sfException $e)
    {
    }

    if ('actorsRelatedByentityTypeId' == $name)
    {
      return true;
    }

    if ('actorsRelatedBydescriptionStatusId' == $name)
    {
      return true;
    }

    if ('actorsRelatedBydescriptionDetailId' == $name)
    {
      return true;
    }

    if ('actorNames' == $name)
    {
      return true;
    }

    if ('digitalObjectsRelatedByusageId' == $name)
    {
      return true;
    }

    if ('digitalObjectsRelatedBymediaTypeId' == $name)
    {
      return true;
    }

    if ('digitalObjectsRelatedBychecksumTypeId' == $name)
    {
      return true;
    }

    if ('events' == $name)
    {
      return true;
    }

    if ('functionsRelatedBytypeId' == $name)
    {
      return true;
    }

    if ('functionsRelatedBydescriptionStatusId' == $name)
    {
      return true;
    }

    if ('functionsRelatedBydescriptionLevelId' == $name)
    {
      return true;
    }

    if ('historicalEventsRelatedBytypeId' == $name)
    {
      return true;
    }

    if ('informationObjectsRelatedBylevelOfDescriptionId' == $name)
    {
      return true;
    }

    if ('informationObjectsRelatedBycollectionTypeId' == $name)
    {
      return true;
    }

    if ('informationObjectsRelatedBydescriptionStatusId' == $name)
    {
      return true;
    }

    if ('informationObjectsRelatedBydescriptionDetailId' == $name)
    {
      return true;
    }

    if ('notes' == $name)
    {
      return true;
    }

    if ('objectTermRelations' == $name)
    {
      return true;
    }

    if ('physicalObjects' == $name)
    {
      return true;
    }

    if ('placesRelatedBycountryId' == $name)
    {
      return true;
    }

    if ('placesRelatedBytypeId' == $name)
    {
      return true;
    }

    if ('placeMapRelations' == $name)
    {
      return true;
    }

    if ('rightss' == $name)
    {
      return true;
    }

    if ('relations' == $name)
    {
      return true;
    }

    if ('repositorysRelatedBytypeId' == $name)
    {
      return true;
    }

    if ('repositorysRelatedBydescStatusId' == $name)
    {
      return true;
    }

    if ('repositorysRelatedBydescDetailId' == $name)
    {
      return true;
    }

    if ('rightsActorRelations' == $name)
    {
      return true;
    }

    if ('rightsTermRelationsRelatedBytermId' == $name)
    {
      return true;
    }

    if ('rightsTermRelationsRelatedBytypeId' == $name)
    {
      return true;
    }

    if ('statussRelatedBytypeId' == $name)
    {
      return true;
    }

    if ('statussRelatedBystatusId' == $name)
    {
      return true;
    }

    if ('systemEvents' == $name)
    {
      return true;
    }

    if ('termsRelatedByparentId' == $name)
    {
      return true;
    }

    if ('termI18ns' == $name)
    {
      return true;
    }

    try
    {
      if (!$value = call_user_func_array(array($this->getCurrenttermI18n($options), '__isset'), $args) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrenttermI18n(array('sourceCulture' => true) + $options), '__isset'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
    }

    if ('ancestors' == $name)
    {
      return true;
    }

    if ('descendants' == $name)
    {
      return true;
    }

    throw new sfException('Unknown record property "'.$name.'" on "'.get_class($this).'"');
  }

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    try
    {
      return call_user_func_array(array($this, 'QubitObject::__get'), $args);
    }
    catch (sfException $e)
    {
    }

    if ('actorsRelatedByentityTypeId' == $name)
    {
      if (!isset($this->refFkValues['actorsRelatedByentityTypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['actorsRelatedByentityTypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['actorsRelatedByentityTypeId'] = self::getactorsRelatedByentityTypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['actorsRelatedByentityTypeId'];
    }

    if ('actorsRelatedBydescriptionStatusId' == $name)
    {
      if (!isset($this->refFkValues['actorsRelatedBydescriptionStatusId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['actorsRelatedBydescriptionStatusId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['actorsRelatedBydescriptionStatusId'] = self::getactorsRelatedBydescriptionStatusIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['actorsRelatedBydescriptionStatusId'];
    }

    if ('actorsRelatedBydescriptionDetailId' == $name)
    {
      if (!isset($this->refFkValues['actorsRelatedBydescriptionDetailId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['actorsRelatedBydescriptionDetailId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['actorsRelatedBydescriptionDetailId'] = self::getactorsRelatedBydescriptionDetailIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['actorsRelatedBydescriptionDetailId'];
    }

    if ('actorNames' == $name)
    {
      if (!isset($this->refFkValues['actorNames']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['actorNames'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['actorNames'] = self::getactorNamesById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['actorNames'];
    }

    if ('digitalObjectsRelatedByusageId' == $name)
    {
      if (!isset($this->refFkValues['digitalObjectsRelatedByusageId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['digitalObjectsRelatedByusageId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['digitalObjectsRelatedByusageId'] = self::getdigitalObjectsRelatedByusageIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['digitalObjectsRelatedByusageId'];
    }

    if ('digitalObjectsRelatedBymediaTypeId' == $name)
    {
      if (!isset($this->refFkValues['digitalObjectsRelatedBymediaTypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['digitalObjectsRelatedBymediaTypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['digitalObjectsRelatedBymediaTypeId'] = self::getdigitalObjectsRelatedBymediaTypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['digitalObjectsRelatedBymediaTypeId'];
    }

    if ('digitalObjectsRelatedBychecksumTypeId' == $name)
    {
      if (!isset($this->refFkValues['digitalObjectsRelatedBychecksumTypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['digitalObjectsRelatedBychecksumTypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['digitalObjectsRelatedBychecksumTypeId'] = self::getdigitalObjectsRelatedBychecksumTypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['digitalObjectsRelatedBychecksumTypeId'];
    }

    if ('events' == $name)
    {
      if (!isset($this->refFkValues['events']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['events'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['events'] = self::geteventsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['events'];
    }

    if ('functionsRelatedBytypeId' == $name)
    {
      if (!isset($this->refFkValues['functionsRelatedBytypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['functionsRelatedBytypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['functionsRelatedBytypeId'] = self::getfunctionsRelatedBytypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['functionsRelatedBytypeId'];
    }

    if ('functionsRelatedBydescriptionStatusId' == $name)
    {
      if (!isset($this->refFkValues['functionsRelatedBydescriptionStatusId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['functionsRelatedBydescriptionStatusId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['functionsRelatedBydescriptionStatusId'] = self::getfunctionsRelatedBydescriptionStatusIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['functionsRelatedBydescriptionStatusId'];
    }

    if ('functionsRelatedBydescriptionLevelId' == $name)
    {
      if (!isset($this->refFkValues['functionsRelatedBydescriptionLevelId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['functionsRelatedBydescriptionLevelId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['functionsRelatedBydescriptionLevelId'] = self::getfunctionsRelatedBydescriptionLevelIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['functionsRelatedBydescriptionLevelId'];
    }

    if ('historicalEventsRelatedBytypeId' == $name)
    {
      if (!isset($this->refFkValues['historicalEventsRelatedBytypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['historicalEventsRelatedBytypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['historicalEventsRelatedBytypeId'] = self::gethistoricalEventsRelatedBytypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['historicalEventsRelatedBytypeId'];
    }

    if ('informationObjectsRelatedBylevelOfDescriptionId' == $name)
    {
      if (!isset($this->refFkValues['informationObjectsRelatedBylevelOfDescriptionId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['informationObjectsRelatedBylevelOfDescriptionId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['informationObjectsRelatedBylevelOfDescriptionId'] = self::getinformationObjectsRelatedBylevelOfDescriptionIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['informationObjectsRelatedBylevelOfDescriptionId'];
    }

    if ('informationObjectsRelatedBycollectionTypeId' == $name)
    {
      if (!isset($this->refFkValues['informationObjectsRelatedBycollectionTypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['informationObjectsRelatedBycollectionTypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['informationObjectsRelatedBycollectionTypeId'] = self::getinformationObjectsRelatedBycollectionTypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['informationObjectsRelatedBycollectionTypeId'];
    }

    if ('informationObjectsRelatedBydescriptionStatusId' == $name)
    {
      if (!isset($this->refFkValues['informationObjectsRelatedBydescriptionStatusId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['informationObjectsRelatedBydescriptionStatusId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['informationObjectsRelatedBydescriptionStatusId'] = self::getinformationObjectsRelatedBydescriptionStatusIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['informationObjectsRelatedBydescriptionStatusId'];
    }

    if ('informationObjectsRelatedBydescriptionDetailId' == $name)
    {
      if (!isset($this->refFkValues['informationObjectsRelatedBydescriptionDetailId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['informationObjectsRelatedBydescriptionDetailId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['informationObjectsRelatedBydescriptionDetailId'] = self::getinformationObjectsRelatedBydescriptionDetailIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['informationObjectsRelatedBydescriptionDetailId'];
    }

    if ('notes' == $name)
    {
      if (!isset($this->refFkValues['notes']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['notes'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['notes'] = self::getnotesById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['notes'];
    }

    if ('objectTermRelations' == $name)
    {
      if (!isset($this->refFkValues['objectTermRelations']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['objectTermRelations'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['objectTermRelations'] = self::getobjectTermRelationsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['objectTermRelations'];
    }

    if ('physicalObjects' == $name)
    {
      if (!isset($this->refFkValues['physicalObjects']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['physicalObjects'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['physicalObjects'] = self::getphysicalObjectsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['physicalObjects'];
    }

    if ('placesRelatedBycountryId' == $name)
    {
      if (!isset($this->refFkValues['placesRelatedBycountryId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['placesRelatedBycountryId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['placesRelatedBycountryId'] = self::getplacesRelatedBycountryIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['placesRelatedBycountryId'];
    }

    if ('placesRelatedBytypeId' == $name)
    {
      if (!isset($this->refFkValues['placesRelatedBytypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['placesRelatedBytypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['placesRelatedBytypeId'] = self::getplacesRelatedBytypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['placesRelatedBytypeId'];
    }

    if ('placeMapRelations' == $name)
    {
      if (!isset($this->refFkValues['placeMapRelations']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['placeMapRelations'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['placeMapRelations'] = self::getplaceMapRelationsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['placeMapRelations'];
    }

    if ('rightss' == $name)
    {
      if (!isset($this->refFkValues['rightss']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['rightss'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['rightss'] = self::getrightssById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['rightss'];
    }

    if ('relations' == $name)
    {
      if (!isset($this->refFkValues['relations']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['relations'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['relations'] = self::getrelationsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['relations'];
    }

    if ('repositorysRelatedBytypeId' == $name)
    {
      if (!isset($this->refFkValues['repositorysRelatedBytypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['repositorysRelatedBytypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['repositorysRelatedBytypeId'] = self::getrepositorysRelatedBytypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['repositorysRelatedBytypeId'];
    }

    if ('repositorysRelatedBydescStatusId' == $name)
    {
      if (!isset($this->refFkValues['repositorysRelatedBydescStatusId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['repositorysRelatedBydescStatusId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['repositorysRelatedBydescStatusId'] = self::getrepositorysRelatedBydescStatusIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['repositorysRelatedBydescStatusId'];
    }

    if ('repositorysRelatedBydescDetailId' == $name)
    {
      if (!isset($this->refFkValues['repositorysRelatedBydescDetailId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['repositorysRelatedBydescDetailId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['repositorysRelatedBydescDetailId'] = self::getrepositorysRelatedBydescDetailIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['repositorysRelatedBydescDetailId'];
    }

    if ('rightsActorRelations' == $name)
    {
      if (!isset($this->refFkValues['rightsActorRelations']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['rightsActorRelations'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['rightsActorRelations'] = self::getrightsActorRelationsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['rightsActorRelations'];
    }

    if ('rightsTermRelationsRelatedBytermId' == $name)
    {
      if (!isset($this->refFkValues['rightsTermRelationsRelatedBytermId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['rightsTermRelationsRelatedBytermId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['rightsTermRelationsRelatedBytermId'] = self::getrightsTermRelationsRelatedBytermIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['rightsTermRelationsRelatedBytermId'];
    }

    if ('rightsTermRelationsRelatedBytypeId' == $name)
    {
      if (!isset($this->refFkValues['rightsTermRelationsRelatedBytypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['rightsTermRelationsRelatedBytypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['rightsTermRelationsRelatedBytypeId'] = self::getrightsTermRelationsRelatedBytypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['rightsTermRelationsRelatedBytypeId'];
    }

    if ('statussRelatedBytypeId' == $name)
    {
      if (!isset($this->refFkValues['statussRelatedBytypeId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['statussRelatedBytypeId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['statussRelatedBytypeId'] = self::getstatussRelatedBytypeIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['statussRelatedBytypeId'];
    }

    if ('statussRelatedBystatusId' == $name)
    {
      if (!isset($this->refFkValues['statussRelatedBystatusId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['statussRelatedBystatusId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['statussRelatedBystatusId'] = self::getstatussRelatedBystatusIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['statussRelatedBystatusId'];
    }

    if ('systemEvents' == $name)
    {
      if (!isset($this->refFkValues['systemEvents']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['systemEvents'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['systemEvents'] = self::getsystemEventsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['systemEvents'];
    }

    if ('termsRelatedByparentId' == $name)
    {
      if (!isset($this->refFkValues['termsRelatedByparentId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['termsRelatedByparentId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['termsRelatedByparentId'] = self::gettermsRelatedByparentIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['termsRelatedByparentId'];
    }

    if ('termI18ns' == $name)
    {
      if (!isset($this->refFkValues['termI18ns']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['termI18ns'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['termI18ns'] = self::gettermI18nsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['termI18ns'];
    }

    try
    {
      if (1 > strlen($value = call_user_func_array(array($this->getCurrenttermI18n($options), '__get'), $args)) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrenttermI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
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

    throw new sfException('Unknown record property "'.$name.'" on "'.get_class($this).'"');
  }

  public function __set($name, $value)
  {
    $args = func_get_args();

    $options = array();
    if (2 < count($args))
    {
      $options = $args[2];
    }

    call_user_func_array(array($this, 'QubitObject::__set'), $args);

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

    call_user_func_array(array($this, 'QubitObject::__unset'), $args);

    call_user_func_array(array($this->getCurrenttermI18n($options), '__unset'), $args);

    return $this;
  }

  public function clear()
  {
    foreach ($this->termI18ns as $termI18n)
    {
      $termI18n->clear();
    }

    return parent::clear();
  }

  public function save($connection = null)
  {
    parent::save($connection);

    foreach ($this->termI18ns as $termI18n)
    {
      $termI18n->id = $this->id;

      $termI18n->save($connection);
    }

    return $this;
  }

  protected function insert($connection = null)
  {
    $this->updateNestedSet($connection);

    parent::insert($connection);

    return $this;
  }

  protected function update($connection = null)
  {
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

    parent::update($connection);

    return $this;
  }

  public function delete($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('This object has already been deleted.');
    }

    $this->clear();
    $this->deleteFromNestedSet($connection);

    parent::delete($connection);

    return $this;
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

  public static function addstatussRelatedBytypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitStatus::TYPE_ID, $id);

    return $criteria;
  }

  public static function getstatussRelatedBytypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addstatussRelatedBytypeIdCriteriaById($criteria, $id);

    return QubitStatus::get($criteria, $options);
  }

  public function addstatussRelatedBytypeIdCriteria(Criteria $criteria)
  {
    return self::addstatussRelatedBytypeIdCriteriaById($criteria, $this->id);
  }

  public static function addstatussRelatedBystatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitStatus::STATUS_ID, $id);

    return $criteria;
  }

  public static function getstatussRelatedBystatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addstatussRelatedBystatusIdCriteriaById($criteria, $id);

    return QubitStatus::get($criteria, $options);
  }

  public function addstatussRelatedBystatusIdCriteria(Criteria $criteria)
  {
    return self::addstatussRelatedBystatusIdCriteriaById($criteria, $this->id);
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

    $termI18ns = $this->termI18ns->indexBy('culture');
    if (!isset($termI18ns[$options['culture']]))
    {
      $termI18ns[$options['culture']] = new QubitTermI18n;
    }

    return $termI18ns[$options['culture']];
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
      $parent->clear();

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
