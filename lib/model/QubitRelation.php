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

class QubitRelation extends BaseRelation
{
  public function save($connection = null)
  {
    // TODO: $cleanObject = $this->getObject()->clean();
    $cleanObjectId = $this->columnValues['object_id'];

    // TODO: $cleanSubject = $this->getSubject()->clean();
    $cleanSubjectId = $this->columnValues['subject_id'];

    parent::save($connection);

    if ($cleanObjectId != $this->getObjectId() && QubitInformationObject::getById($cleanObjectId) !== null)
    {
      SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanObjectId));
    }

    if ($cleanSubjectId != $this->getSubjectId() && QubitInformationObject::getById($cleanSubjectId) !== null)
    {
      SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanSubjectId));
    }

    if ($this->getObject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getObject());
    }

    if ($this->getSubject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getSubject());
    }
  }

  public function delete($connection = null)
  {
    parent::delete($connection);

    if ($this->getObject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getObject());
    }

    if ($this->getSubject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getSubject());
    }
  }

  /**
   * Get records from relation table linked to object (semantic)
   * QubitObject identified by primary key $id.
   *
   * @param integer $id primary key of "object" QubitObject
   * @param integer $typeId filter by predicate
   * @return QubitQuery collection of QubitRelation objects
   */
  public static function getRelationsByObjectId($id, $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::OBJECT_ID, $id);

    if (isset($options['typeId']))
    {
      $criteria->add(QubitRelation::TYPE_ID, $options['typeId']);
    }

    return QubitRelation::get($criteria, $options);
  }

  /**
   * Get records from relation table linked to subject
   * QubitObject identified by primary key $id.
   *
   * @param integer $id primary key of "subject" QubitObject
   * @param integer $typeId filter by predicate
   * @return QubitQuery collection of QubitRelation objects
   */
  public static function getRelationsBySubjectId($id, $typeId=null, $options=array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::SUBJECT_ID, $id);

    if (isset($options['typeId']))
    {
      $criteria->add(QubitRelation::TYPE_ID, $options['typeId']);
    }

    return QubitRelation::get($criteria, $options);
  }

  /**
   * Get related subject objects via QubitRelation many-to-many relationship
   *
   * @param string  $className type of objects to return
   * @param integer $objectId primary key of "object" QubitObject
   * @param array   $options list of options to pass to QubitQuery
   * @return QubitQuery collection of QubitObjects
   */
  public static function getRelatedSubjectsByObjectId($className, $objectId, $options=array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::OBJECT_ID, $objectId);
    $criteria->addJoin(QubitRelation::SUBJECT_ID, QubitObject::ID);
    $criteria->add(QubitObject::CLASS_NAME, $className);

    if (isset($options['typeId']))
    {
      $criteria->add(QubitRelation::TYPE_ID, $options['typeId']);
    }

    return call_user_func(array($className, 'get'), $criteria, $options);
  }

  /**
   * Get related "object" (semantic) QubitObjects
   *
   * @param string  $className type of objects to return
   * @param integer $subjectId primary key of "subject" QubitObject
   * @param array   $options list of options to pass to QubitQuery
   * @return QubitQuery collection of QubitObjects
   */
  public static function getRelatedObjectsBySubjectId($className, $subjectId, $options=array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::SUBJECT_ID, $subjectId);
    $criteria->addJoin(QubitRelation::OBJECT_ID, QubitObject::ID);
    $criteria->add(QubitObject::CLASS_NAME, $className);

    if (isset($options['typeId']))
    {
      $criteria->add(QubitRelation::TYPE_ID, $options['typeId']);
    }

    return call_user_func(array($className, 'get'), $criteria, $options);
  }
}
