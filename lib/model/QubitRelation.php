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

/**
 * Represent relations between data objects as a subject-action-object
 * triplet.
 *
 * @package    qubit
 * @subpackage relation
 * @version    svn: $Id$
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class QubitRelation extends BaseRelation
{
  protected $indexOnSave = true;

  /**
   * Additional save functionality (e.g. update search index)
   *
   * @param mixed $connection a database connection object
   * @return QubitInformationObject self-reference
   */
  public function save($connection = null)
  {
    // TODO: $cleanObject = $this->object->clean;
    $cleanObjectId = $this->__get('objectId', array('clean' => true));

    // TODO: $cleanSubject = $this->subject->clean;
    $cleanSubjectId = $this->__get('subjectId', array('clean' => true));

    parent::save($connection);

    if ($this->indexOnSave())
    {
      if ($this->objectId != $cleanObjectId && null !== QubitInformationObject::getById($cleanObjectId))
      {
        SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanObjectId));
      }

      if ($this->subjectId != $cleanSubjectId && null != QubitInformationObject::getById($cleanSubjectId))
      {
        SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanSubjectId));
      }

      if ($this->object instanceof QubitInformationObject)
      {
        SearchIndex::updateTranslatedLanguages($this->object);
      }

      if ($this->subject instanceof QubitInformationObject)
      {
        SearchIndex::updateTranslatedLanguages($this->subject);
      }
    }

    return $this;
  }

  /**
   * Flag whether to update the search index when saving this object
   *
   * @param boolean $bool flag value
   * @return QubitInformationObject self-reference
   */
  public function setIndexOnSave($bool)
  {
    if ($bool)
    {
      $this->indexOnSave = true;
    }
    else
    {
      $this->indexOnSave = false;
    }

    return $this;
  }

  /**
   * Update search index on save?
   *
   * @return boolean current flag
   */
  public function indexOnSave()
  {
    return $this->indexOnSave;
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
   * @param array   $options optional parameters
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
   * @param array   $options optional parameters
   * @return QubitQuery collection of QubitRelation objects
   */
  public static function getRelationsBySubjectId($id, $options=array())
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
   * Get all relations from/to given object $id
   *
   * @param integer $id primary key of object
   * @param array   $options optional parameters
   * @return QubitQuery collection of QubitRelation objects
   */
  public static function getBySubjectOrObjectId($id, $options=array())
  {
    $criteria = new Criteria;

    $criterion1 = $criteria->getNewCriterion(QubitRelation::OBJECT_ID, $id, Criteria::EQUAL);
    $criterion2 = $criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $id, Criteria::EQUAL);
    $criterion1->addOr($criterion2);

    // If restricting by relation type
    if (isset($options['typeId']))
    {
      $criterion3 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, $options['typeId'], Criteria::EQUAL);
      $criterion1->addAnd($criterion3);
    }

    $criteria->add($criterion1);
    $criteria->addAscendingOrderByColumn(QubitRelation::TYPE_ID);

    return QubitRelation::get($criteria);
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

  /**
   * Get opposite vertex of relation
   *
   * @param integer $referenceId primary key of reference object
   * @return mixed other object in relationship
   */
  public function getOpposedObject($referenceId)
  {
    $opposite = null;
    if ($this->subjectId == $referenceId)
    {
      $opposite = $this->getObject();
    }
    else if ($this->objectId == $referenceId)
    {
      $opposite = $this->getSubject();
    }

    return $opposite;
  }

  /**
   * Add a related note for this object
   *
   * @param string $note text of note
   * @param integer $noteTypeId QubitTerm constant describing note
   * @return QubitNote new note object
   */
  public function addNote($text, $noteTypeId)
  {
    // Don't create a note with a blank text or a null noteTypeId
    if (0 < strlen($text) && 0 !== intval($noteTypeId))
    {
      $newNote = new QubitNote;
      $newNote->setScope('QubitRelation');
      $newNote->setContent($text);
      $newNote->setTypeId($noteTypeId);

      $this->notes[] = $newNote;
    }

    return $this;
  }

  /**
   * Update an related note
   *
   * @param string $note text of note
   * @param integer $noteTypeId QubitTerm constant describing note
   * @return QubitNote note object
   */
  public function updateNote($text, $noteTypeId)
  {
    $existingNote = false;
    foreach ($this->notes as $key => $note)
    {
      if ($note->typeId == $noteTypeId)
      {
        if (0 == strlen($text))
        {
          // If $text is blank, then delete note object
          $note->delete();
          unset($this->notes[$key]);
        }
        else
        {
          // Update existing note
          $note->setContent($text);
        }

        $existingNote = true;
        break;
      }
    }

    if (false === $existingNote)
    {
      // Add new note
      return $this->addNote($text, $noteTypeId);
    }
    else
    {
      return $this;
    }
  }

  /**
   * Get a note related to this object filtered by TYPE_ID column
   *
   * @param integer $noteTypeId note type
   * @return QubitNote found note
   */
  public function getNoteByTypeId($noteTypeId)
  {
    $criteria = new Criteria;
    $criteria->add(QubitNote::OBJECT_ID, $this->getId(), Criteria::EQUAL);
    $criteria->add(QubitNote::TYPE_ID, $noteTypeId, Criteria::EQUAL);

    return QubitNote::getOne($criteria);
  }

  /**
   * Get start and end date as an array
   *
   * @return array start date and/or end date
   */
  public function getDates()
  {
    $dateArray = array();
    if (null !== $this->getStartDate())
    {
      $dateArray['start'] = $this->getStartDate();
    }

    if (null !== $this->getEndDate())
    {
      $dateArray['end'] = $this->getEndDate();
    }

    return $dateArray;
  }
}
