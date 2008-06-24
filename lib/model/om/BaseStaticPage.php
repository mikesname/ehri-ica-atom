<?php

abstract class BaseStaticPage extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_static_page';

  const ID = 'q_static_page.ID';
  const PERMALINK = 'q_static_page.PERMALINK';
  const CREATED_AT = 'q_static_page.CREATED_AT';
  const UPDATED_AT = 'q_static_page.UPDATED_AT';
  const SOURCE_CULTURE = 'q_static_page.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitStaticPage::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitStaticPage::ID);
    $criteria->addSelectColumn(QubitStaticPage::PERMALINK);
    $criteria->addSelectColumn(QubitStaticPage::CREATED_AT);
    $criteria->addSelectColumn(QubitStaticPage::UPDATED_AT);
    $criteria->addSelectColumn(QubitStaticPage::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitStaticPage::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitStaticPage', $options);
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
    $criteria->add(QubitStaticPage::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  protected $permalink = null;

  public function getPermalink()
  {
    return $this->permalink;
  }

  public function setPermalink($permalink)
  {
    $this->permalink = $permalink;

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

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['permalink'] = $this->permalink;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->permalink = $results->getString($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitStaticPage::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitStaticPage::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->staticPageI18ns as $staticPageI18n)
    {
      $staticPageI18n->setId($this->id);

      $affectedRows += $staticPageI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitStaticPage::ID, $this->id);
    }

    if ($this->isColumnModified('permalink'))
    {
      $criteria->add(QubitStaticPage::PERMALINK, $this->permalink);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitStaticPage::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitStaticPage::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitStaticPage::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitStaticPage::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::update($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitStaticPage::ID, $this->id);
    }

    if ($this->isColumnModified('permalink'))
    {
      $criteria->add(QubitStaticPage::PERMALINK, $this->permalink);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitStaticPage::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitStaticPage::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitStaticPage::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitStaticPage::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitStaticPage::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addStaticPageI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitStaticPageI18n::ID, $id);

    return $criteria;
  }

  public static function getStaticPageI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addStaticPageI18nsCriteriaById($criteria, $id);

    return QubitStaticPageI18n::get($criteria, $options);
  }

  public function addStaticPageI18nsCriteria(Criteria $criteria)
  {
    return self::addStaticPageI18nsCriteriaById($criteria, $this->id);
  }

  protected $staticPageI18ns = null;

  public function getStaticPageI18ns(array $options = array())
  {
    if (!isset($this->staticPageI18ns))
    {
      if (!isset($this->id))
      {
        $this->staticPageI18ns = QubitQuery::create();
      }
      else
      {
        $this->staticPageI18ns = self::getStaticPageI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->staticPageI18ns;
  }

  public function getTitle(array $options = array())
  {
    $title = $this->getCurrentStaticPageI18n($options)->getTitle();
    if (!empty($options['cultureFallback']) && $title === null)
    {
      $title = $this->getCurrentStaticPageI18n(array('sourceCulture' => true) + $options)->getTitle();
    }

    return $title;
  }

  public function setTitle($value, array $options = array())
  {
    $this->getCurrentStaticPageI18n($options)->setTitle($value);

    return $this;
  }

  public function getContent(array $options = array())
  {
    $content = $this->getCurrentStaticPageI18n($options)->getContent();
    if (!empty($options['cultureFallback']) && $content === null)
    {
      $content = $this->getCurrentStaticPageI18n(array('sourceCulture' => true) + $options)->getContent();
    }

    return $content;
  }

  public function setContent($value, array $options = array())
  {
    $this->getCurrentStaticPageI18n($options)->setContent($value);

    return $this;
  }

  public function getCurrentStaticPageI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->staticPageI18ns[$options['culture']]))
    {
      if (null === $staticPageI18n = QubitStaticPageI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $staticPageI18n = new QubitStaticPageI18n;
        $staticPageI18n->setCulture($options['culture']);
      }
      $this->staticPageI18ns[$options['culture']] = $staticPageI18n;
    }

    return $this->staticPageI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.StaticPageMapBuilder');
