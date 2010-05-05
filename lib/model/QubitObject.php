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

require_once 'Zend/Acl/Resource/Interface.php';

class QubitObject extends BaseObject implements Zend_Acl_Resource_Interface
{
  public function save($connection = null)
  {
    parent::save($connection);

    // Save updated objectTermRelations
    foreach ($this->objectTermRelationsRelatedByobjectId as $relation)
    {
      $relation->setIndexOnSave(false);
      $relation->object = $this;

      try
      {
        $relation->save();
      }
      catch (PropelException $e)
      {
      }
    }

    // Save updated notes
    foreach ($this->notes as $note)
    {
      $note->setIndexOnSave(false);
      $note->object = $this;

      try
      {
        $note->save();
      }
      catch (PropelException $e)
      {
      }
    }

    // Save updated properties
    foreach ($this->propertys as $property)
    {
      $property->setIndexOnSave(false);
      $property->object = $this;

      try
      {
        $property->save();
      }
      catch (PropelException $e)
      {
      }
    }

    // Save updated object relations
    foreach ($this->relationsRelatedByobjectId as $relation)
    {
      $relation->setIndexOnSave(false);
      $relation->object = $this;

      try
      {
        $relation->save();
      }
      catch (PropelException $e)
      {
      }
    }

    // Save updated subject relations
    foreach ($this->relationsRelatedBysubjectId as $relation)
    {
      $relation->setIndexOnSave(false);
      $relation->subject = $this;

      try
      {
        $relation->save();
      }
      catch (PropelException $e)
      {
      }
    }

    // Save updated other namnes
    foreach ($this->otherNames as $otherName)
    {
      $otherName->object = $this;

      try
      {
        $otherName->save();
      }
      catch (PropelException $e)
      {
      }
    }

    return $this;
  }

  /**
   * Required by Zend_Acl_Resource_Interface interface
   */
  public function getResourceId()
  {
    return $this->id;
  }

  /********************
        Status
  *********************/

  public function setStatus($options = array())
  {
    $status = $this->getStatus(array('typeId' => $options['typeId']));
    // only create a new status object if type is not already set
    if ($status === null)
    {
      $status = new QubitStatus;
      $status->setTypeId($options['typeId']);
    }
    $status->setStatusId($options['statusId']);
    $this->statuss[] = $status;

    return $this;
  }

  public function getStatus($options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitStatus::OBJECT_ID, $this->getId());
    $criteria->add(QubitStatus::TYPE_ID, $options['typeId']);

    return QubitStatus::getOne($criteria);
  }

  public function getNotesByType(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    if (isset($options['noteTypeId']))
    {
      $criteria->add(QubitNote::TYPE_ID, $options['noteTypeId']);
    }
    if (isset($options['exclude']))
    {
      // Turn exclude string into an array
      $excludes = (is_array($options['exclude'])) ? $options['exclude'] : array($options['exclude']);

      foreach ($excludes as $exclude)
      {
        $criteria->addAnd(QubitNote::TYPE_ID, $exclude, Criteria::NOT_EQUAL);
      }
    }

    return QubitNote::get($criteria);
  }

  public function getNotesByTaxonomy(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    if (isset($options['taxonomyId']))
    {
      $criteria->add(QubitTerm::TAXONOMY_ID, $options['taxonomyId']);
    }

    return QubitNote::get($criteria);
  }


  /********************
       Other names
  *********************/

  public function getOtherNames($options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitOtherName::OBJECT_ID, $this->getId());

    if (isset($options['typeId']))
    {
      $criteria->add(QubitOtherName::TYPE_ID, $options['typeId']);
    }

    return QubitOtherName::get($criteria);
  }
}
