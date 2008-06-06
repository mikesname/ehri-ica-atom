<?php

abstract class BaseTaxonomy
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_taxonomy';

  const USAGE = 'q_taxonomy.USAGE';
  const CREATED_AT = 'q_taxonomy.CREATED_AT';
  const UPDATED_AT = 'q_taxonomy.UPDATED_AT';
  const SOURCE_CULTURE = 'q_taxonomy.SOURCE_CULTURE';
  const ID = 'q_taxonomy.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitTaxonomy::USAGE);
    $criteria->addSelectColumn(QubitTaxonomy::CREATED_AT);
    $criteria->addSelectColumn(QubitTaxonomy::UPDATED_AT);
    $criteria->addSelectColumn(QubitTaxonomy::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitTaxonomy::ID);

    return $criteria;
  }

  protected static $taxonomys = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$taxonomys[$id = $resultSet->getInt(5)]))
    {
      $taxonomy = new QubitTaxonomy;
      $taxonomy->hydrate($resultSet);

      self::$taxonomys[$id] = $taxonomy;
    }

    return self::$taxonomys[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTaxonomy::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitTaxonomy', $options);
  }

  public static function getAll(array $options = array())
  {
    return self::get(new Criteria, $options);
  }

  public static function getOne(Criteria $criteria, array $options = array())
  {
    $criteria->setLimit(1);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitTaxonomy::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTaxonomy::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $usage = null;

  public function getUsage()
  {
    return $this->usage;
  }

  public function setUsage($usage)
  {
    $this->usage = $usage;

    return $this;
  }

  protected $createdAt = null;

  public function getCreatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->createdAt);
    }

    return $this->createdAt;
  }

  public function setCreatedAt($createdAt)
  {
    if (is_string($createdAt) && false === $createdAt = strtotime($createdAt))
    {
      throw new PropelException('Unable to parse date / time value for [createdAt] from input: '.var_export($createdAt, true));
    }

    $this->createdAt = $createdAt;

    return $this;
  }

  protected $updatedAt = null;

  public function getUpdatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->updatedAt);
    }

    return $this->updatedAt;
  }

  public function setUpdatedAt($updatedAt)
  {
    if (is_string($updatedAt) && false === $updatedAt = strtotime($updatedAt))
    {
      throw new PropelException('Unable to parse date / time value for [updatedAt] from input: '.var_export($updatedAt, true));
    }

    $this->updatedAt = $updatedAt;

    return $this;
  }

  protected $sourceCulture = null;

  public function getSourceCulture()
  {
    return $this->sourceCulture;
  }

  public function setSourceCulture($sourceCulture)
  {
    $this->sourceCulture = $sourceCulture;

    return $this;
  }

  protected $id = null;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  protected $new = true;

  protected $deleted = false;

  protected $columnValues = null;

  protected function isColumnModified($name)
  {
    return $this->$name != $this->columnValues[$name];
  }

  protected function resetModified()
  {
    $this->columnValues['usage'] = $this->usage;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->usage = $results->getString($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTaxonomy::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitTaxonomy::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('You cannot save an object that has been deleted.');
    }

    $affectedRows = 0;

    if ($this->new)
    {
      $affectedRows += $this->insert($connection);
    }
    else
    {
      $affectedRows += $this->update($connection);
    }

    $this->new = false;
    $this->resetModified();

    foreach ($this->taxonomyI18ns as $taxonomyI18n)
    {
      $taxonomyI18n->setId($this->id);

      $affectedRows += $taxonomyI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('usage'))
    {
      $criteria->add(QubitTaxonomy::USAGE, $this->usage);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitTaxonomy::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitTaxonomy::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitTaxonomy::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitTaxonomy::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTaxonomy::DATABASE_NAME);
    }

    $id = BasePeer::doInsert($criteria, $connection);
    $this->id = $id;
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('usage'))
    {
      $criteria->add(QubitTaxonomy::USAGE, $this->usage);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitTaxonomy::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitTaxonomy::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitTaxonomy::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitTaxonomy::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitTaxonomy::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitTaxonomy::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public function delete($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('This object has already been deleted.');
    }

    $affectedRows = 0;

    $criteria = new Criteria;
    $criteria->add(QubitTaxonomy::ID, $this->id);

    $affectedRows += self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $affectedRows;
  }

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

  public static function addTermsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitTerm::TAXONOMY_ID, $id);

    return $criteria;
  }

  public static function getTermsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addTermsCriteriaById($criteria, $id);

    return QubitTerm::get($criteria, $options);
  }

  public function addTermsCriteria(Criteria $criteria)
  {
    return self::addTermsCriteriaById($criteria, $this->id);
  }

  protected $terms = null;

  public function getTerms(array $options = array())
  {
    if (!isset($this->terms))
    {
      if (!isset($this->id))
      {
        $this->terms = QubitQuery::create();
      }
      else
      {
        $this->terms = self::getTermsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->terms;
  }

  public static function addTaxonomyI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitTaxonomyI18n::ID, $id);

    return $criteria;
  }

  public static function getTaxonomyI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addTaxonomyI18nsCriteriaById($criteria, $id);

    return QubitTaxonomyI18n::get($criteria, $options);
  }

  public function addTaxonomyI18nsCriteria(Criteria $criteria)
  {
    return self::addTaxonomyI18nsCriteriaById($criteria, $this->id);
  }

  protected $taxonomyI18ns = null;

  public function getTaxonomyI18ns(array $options = array())
  {
    if (!isset($this->taxonomyI18ns))
    {
      if (!isset($this->id))
      {
        $this->taxonomyI18ns = QubitQuery::create();
      }
      else
      {
        $this->taxonomyI18ns = self::getTaxonomyI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->taxonomyI18ns;
  }

  public function getName(array $options = array())
  {
    return $this->getCurrentTaxonomyI18n($options)->getName();
  }

  public function setName($value, array $options = array())
  {
    $this->getCurrentTaxonomyI18n($options)->setName($value);

    return $this;
  }

  public function getNote(array $options = array())
  {
    return $this->getCurrentTaxonomyI18n($options)->getNote();
  }

  public function setNote($value, array $options = array())
  {
    $this->getCurrentTaxonomyI18n($options)->setNote($value);

    return $this;
  }

  public function getCurrentTaxonomyI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->taxonomyI18ns[$options['culture']]))
    {
      if (null === $taxonomyI18n = QubitTaxonomyI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $taxonomyI18n = new QubitTaxonomyI18n;
        $taxonomyI18n->setCulture($options['culture']);
      }
      $this->taxonomyI18ns[$options['culture']] = $taxonomyI18n;
    }

    return $this->taxonomyI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.TaxonomyMapBuilder');
