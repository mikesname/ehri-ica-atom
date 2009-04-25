<?php

abstract class BaseStaticPage extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_static_page',

    ID = 'q_static_page.ID',
    PERMALINK = 'q_static_page.PERMALINK',
    CREATED_AT = 'q_static_page.CREATED_AT',
    UPDATED_AT = 'q_static_page.UPDATED_AT',
    SOURCE_CULTURE = 'q_static_page.SOURCE_CULTURE';

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

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitStaticPage::DATABASE_NAME)->getTable(QubitStaticPage::TABLE_NAME);
  }

  public function offsetExists($offset, array $options = array())
  {
    if (parent::offsetExists($offset, $options))
    {
      return true;
    }

    if ($this->getCurrentstaticPageI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrentstaticPageI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
    {
      return true;
    }

    return false;
  }

  public function offsetGet($offset, array $options = array())
  {
    if (null !== $value = parent::offsetGet($offset, $options))
    {
      return $value;
    }

    if (null !== $value = $this->getCurrentstaticPageI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrentstaticPageI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrentstaticPageI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
    {
      return $value;
    }
  }

  public function offsetSet($offset, $value, array $options = array())
  {
    parent::offsetSet($offset, $value, $options);

    $this->getCurrentstaticPageI18n($options)->offsetSet($offset, $value, $options);

    return $this;
  }

  public function offsetUnset($offset, array $options = array())
  {
    parent::offsetUnset($offset, $options);

    $this->getCurrentstaticPageI18n($options)->offsetUnset($offset, $options);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->staticPageI18ns as $staticPageI18n)
    {
      $staticPageI18n->setid($this->id);

      $affectedRows += $staticPageI18n->save($connection);
    }

    return $affectedRows;
  }

  public static function addstaticPageI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitStaticPageI18n::ID, $id);

    return $criteria;
  }

  public static function getstaticPageI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addstaticPageI18nsCriteriaById($criteria, $id);

    return QubitStaticPageI18n::get($criteria, $options);
  }

  public function addstaticPageI18nsCriteria(Criteria $criteria)
  {
    return self::addstaticPageI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $staticPageI18ns = null;

  public function getstaticPageI18ns(array $options = array())
  {
    if (!isset($this->staticPageI18ns))
    {
      if (!isset($this->id))
      {
        $this->staticPageI18ns = QubitQuery::create();
      }
      else
      {
        $this->staticPageI18ns = self::getstaticPageI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->staticPageI18ns;
  }

  public function getCurrentstaticPageI18n(array $options = array())
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
      if (!isset($this->id) || null === $staticPageI18n = QubitStaticPageI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $staticPageI18n = new QubitStaticPageI18n;
        $staticPageI18n->setculture($options['culture']);
      }
      $this->staticPageI18ns[$options['culture']] = $staticPageI18n;
    }

    return $this->staticPageI18ns[$options['culture']];
  }
}
