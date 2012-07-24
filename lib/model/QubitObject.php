<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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
  public function __isset($name)
  {
    $args = func_get_args();

    switch ($name)
    {
      case 'slug':

        if (!array_key_exists('slug', $this->values))
        {
          $connection = Propel::getConnection(QubitObject::DATABASE_NAME);

          $statement = $connection->prepare('
            SELECT '.QubitSlug::SLUG.'
            FROM '.QubitSlug::TABLE_NAME.'
            WHERE ? = '.QubitSlug::OBJECT_ID);
          $statement->execute(array($this->id));
          $row = $statement->fetch();
          $this->values['slug'] = $row[0];
        }

        return isset($this->values['slug']);

      default:

        return call_user_func_array(array($this, 'BaseObject::__isset'), $args);
    }
  }

  public function __get($name)
  {
    $args = func_get_args();

    switch ($name)
    {
      case 'slug':

        if (!array_key_exists('slug', $this->values))
        {
          $connection = Propel::getConnection(QubitObject::DATABASE_NAME);

          $statement = $connection->prepare('
            SELECT '.QubitSlug::SLUG.'
            FROM '.QubitSlug::TABLE_NAME.'
            WHERE ? = '.QubitSlug::OBJECT_ID);
          $statement->execute(array($this->id));
          $row = $statement->fetch();
          $this->values['slug'] = $row[0];
        }

        return $this->values['slug'];

      default:

        return call_user_func_array(array($this, 'BaseObject::__get'), $args);
    }
  }

  public function __set($name, $value)
  {
    $args = func_get_args();

    switch ($name)
    {
      case 'slug':
        $this->values['slug'] = $value;

        return $this;

      default:

        return call_user_func_array(array($this, 'BaseObject::__set'), $args);
    }
  }

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

  protected function insert($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
    }

    parent::insert($connection);

    self::insertSlug($connection);

    return $this;
  }

  public function insertSlug($connection)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
    }

    if (isset($this->slug))
    {
      $statement = $connection->prepare('
        INSERT INTO '.QubitSlug::TABLE_NAME.' ('.QubitSlug::OBJECT_ID.', '.QubitSlug::SLUG.')
        VALUES (?, ?)');

      // Unless it is set, get random, digit and letter slug
      if (1 > strlen($this->slug))
      {
        $statement->execute(array($this->id, QubitSlug::getUnique($connection)));

        return $this;
      }

      // Truncate to 235 characters to prevent issue of long title collision
      // causing an infinite loop when computing a unique slug
      $this->slug = substr($this->slug, 0, 235); 

      // Compute unique slug adding contiguous numeric suffix
      $suffix = 2;
      do
      {
        try
        {
          $statement->execute(array($this->id, $this->slug));
          unset($suffix);
        }
        // Collision? Try next suffix
        catch (PDOException $e)
        {
          if (2 == $suffix)
          {
            $this->slug .= "-$suffix";
          }
          else
          {
            $this->slug = preg_replace('/-\d+$/', '', $this->slug, 1)."-$suffix";
          }

          $suffix++;
        }
      }
      while (isset($suffix));
    }

    return $this;
  }

  public function delete($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
    }

    $statement = $connection->prepare('
      DELETE FROM '.QubitSlug::TABLE_NAME.'
      WHERE '.QubitSlug::OBJECT_ID.' = ?');
    $statement->execute(array($this->id));

    // Delete other names
    if (0 < count($this->otherNames))
    {
      foreach ($this->otherNames as $otherName)
      {
        $otherName->delete();
      }
    }

    parent::delete($connection);
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
    $criteria->add(QubitStatus::OBJECT_ID, $this->id);
    $criteria->add(QubitStatus::TYPE_ID, $options['typeId']);

    return QubitStatus::getOne($criteria);
  }

  public function getNotesByType(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->id);
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
    $criteria->add(QubitNote::OBJECT_ID, $this->id);
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
    $criteria->add(QubitOtherName::OBJECT_ID, $this->id);

    if (isset($options['typeId']))
    {
      $criteria->add(QubitOtherName::TYPE_ID, $options['typeId']);
    }

    return QubitOtherName::get($criteria);
  }

  /********************
       Rights
  *********************/

  public function getRights($options = array())
  {
    return QubitRelation::getRelationsBySubjectId($this->id, array('typeId' => QubitTerm::RIGHT_ID));
  }
}
