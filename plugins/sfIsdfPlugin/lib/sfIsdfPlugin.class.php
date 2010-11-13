<?php

/*
 */

class sfIsdfPlugin implements ArrayAccess
{
  protected
    $resource,
    $relatedAuthorityRecord,
    $relatedFunction,
    $relatedResource,
    $maintenanceNote;

  public function __construct(QubitFunction $resource)
  {
    $this->resource = $resource;
  }

  public function offsetExists($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__isset'), $args);
  }

  public function __get($name)
  {
    switch ($name)
    {
      case '_maintenanceNote':

        if (!isset($this->maintenanceNote))
        {
          $criteria = new Criteria;
          $criteria->add(QubitNote::OBJECT_ID, $this->resource->id);
          $criteria->add(QubitNote::TYPE_ID, QubitTerm::MAINTENANCE_NOTE_ID);

          if (1 == count($query = QubitNote::get($criteria)))
          {
            $this->maintenanceNote = $query[0];
          }
          else
          {
            $this->maintenanceNote = new QubitNote;
            $this->maintenanceNote->typeId = QubitTerm::MAINTENANCE_NOTE_ID;

            $this->resource->notes[] = $this->maintenanceNote;
          }
        }

        return $this->maintenanceNote;

      case 'maintenanceNotes':

        return $this->_maintenanceNote->content;

      case 'relatedAuthorityRecord':

        if (!isset($this->relatedAuthorityRecord))
        {
          $criteria = new Criteria;
          $criteria->add(QubitRelation::SUBJECT_ID, $this->resource->id);
          $criteria->addJoin(QubitRelation::OBJECT_ID, QubitActor::ID);

          $this->relatedAuthorityRecord = QubitRelation::get($criteria);
        }

        return $this->relatedAuthorityRecord;

      case 'relatedFunction':

        if (!isset($this->relatedFunction))
        {
          $criteria = new Criteria;
          $criteria->add($criteria->getNewCriterion(QubitRelation::OBJECT_ID, $this->resource->id)
            ->addOr($criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $this->resource->id)));
          $criteria->addAlias('ro', QubitFunction::TABLE_NAME);
          $criteria->addJoin(QubitRelation::OBJECT_ID, 'ro.id');
          $criteria->addAlias('rs', QubitFunction::TABLE_NAME);
          $criteria->addJoin(QubitRelation::SUBJECT_ID, 'rs.id');
          $criteria->addAscendingOrderByColumn(QubitRelation::TYPE_ID);

          $this->relatedFunction = QubitRelation::get($criteria);
        }

        return $this->relatedFunction;

      case 'relatedResource':

        if (!isset($this->relatedResource))
        {
          $criteria = new Criteria;
          $criteria->add(QubitRelation::SUBJECT_ID, $this->resource->id);
          $criteria->addJoin(QubitRelation::OBJECT_ID, QubitInformationObject::ID);

          $this->relatedResource = QubitRelation::get($criteria);
        }

        return $this->relatedResource;

      case 'sourceCulture':

        return $this->resource->sourceCulture;
    }
  }

  public function offsetGet($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__get'), $args);
  }

  public function __set($name, $value)
  {
    switch ($name)
    {
      case 'maintenanceNotes':
        $this->_maintenanceNote->content = $value;

        return $this;
    }
  }

  public function offsetSet($offset, $value)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__set'), $args);
  }

  public function offsetUnset($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__unset'), $args);
  }
}
