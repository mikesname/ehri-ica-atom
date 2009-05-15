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

class QubitObjectBuilder extends SfObjectBuilder
{
  protected
    $peerClassName = null,
    $basePeerClassName = null,

    $classNameColumn = null,
    $cultureColumn = null,
    $nestedSetLeftColumn = null,
    $nestedSetRightColumn = null,
    $sourceCultureColumn = null,

    $inheritanceFk = null,
    $selfFk = null,

    $i18nFk = null,
    $emulateOnDeleteCascade = null,
    $emulateOnDeleteSetNull = null;

  public function __construct(Table $table)
  {
    parent::__construct($table);

    $this->initialize($table);
  }

  public function initialize(Table $table)
  {
    $this->basePeerClassName = preg_replace('/.*\./', null, $this->getBasePeer($table));

    foreach ($table->getColumns() as $column)
    {
      if ($column->getName() == 'class_name')
      {
        $this->classNameColumn = $column;
      }

      if ($column->getAttribute('isCulture'))
      {
        $this->cultureColumn = $column;
      }

      if ($column->getAttribute('nestedSetLeftKey'))
      {
        $this->nestedSetLeftColumn = $column;
      }

      if ($column->getAttribute('nestedSetRightKey'))
      {
        $this->nestedSetRightColumn = $column;
      }

      if ($column->getName() == 'source_culture')
      {
        $this->sourceCultureColumn = $column;
      }
    }

    foreach ($table->getForeignKeys() as $fk)
    {
      foreach ($fk->getLocalColumns() as $localName)
      {
        if ($table->getColumn($localName)->getAttribute('inheritanceKey'))
        {
          $this->inheritanceFk = $fk;
        }
      }

      if ($fk->getForeignTableName() == $table->getName())
      {
        $this->selfFk = $fk;
      }
    }

    foreach ($table->getReferrers() as $refFk)
    {
      if ($refFk->getTable()->getName() == $table->getAttribute('i18nTable'))
      {
        $this->i18nFk = $refFk;
      }

      if (!$this->getPlatform()->supportsNativeDeleteTrigger() || $this->getBuildProperty('emulateForeignKeyConstraints'))
      {
        if ($refFk->getOnDelete() == ForeignKey::CASCADE)
        {
          $this->emulateOnDeleteCascade = true;
        }

        if ($refFk->getOnDelete() == ForeignKey::SETNULL)
        {
          $this->emulateOnDeleteSetNull = true;
        }
      }
    }

    return false;
  }

  protected function getBaseClass()
  {
    if (isset($this->inheritanceFk))
    {
      return self::getNewObjectBuilder($this->getForeignTable($this->inheritanceFk))->getObjectClassName();
    }
  }

  public function getClassName()
  {
    return $this->getBuildProperty('basePrefix').ucfirst($this->getTable()->getPhpName());
  }

  protected function getColumnVarName(Column $column)
  {
    return $column->getPhpName();
  }

  public function getPeerClassName()
  {
    return $this->getStubObjectBuilder()->getClassName();
  }

  protected function getRetrieveMethodName()
  {
    $names = array();
    foreach ($this->getTable()->getPrimaryKey() as $column)
    {
      $names[] = ucfirst($column->getPhpName());
    }

    return 'getBy'.implode($names, 'And');
  }

  protected function getVarName($plural = null)
  {
    $name = $this->getTable()->getPhpName();
    if (!empty($plural))
    {
      $name .= 's';
    }

    return $name;
  }

  protected function addClassOpen(&$script)
  {
    $extends = null;
    if (null !== $baseClass = $this->getBaseClass())
    {
      $extends = ' extends '.preg_replace('/.*\./', null, $baseClass);
    }

    $script .= <<<EOF

abstract class {$this->getClassName()}$extends implements ArrayAccess
{
EOF;
  }

  protected function addClassBody(&$script)
  {
    $this->addConstants($script);
    $this->addSelectMethods($script);
    $this->addRetrieveByPkMethods($script);

    if (!isset($this->inheritanceFk))
    {
      $this->addUpdateMethods($script);
    }

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $this->addAddOrderByPreorder($script);
      $this->addAddRootsCriteria($script);
    }

    $this->addConstructor($script);
    $this->addColumnMethods($script);

    if (!isset($this->inheritanceFk))
    {
      $this->addNew($script);
      $this->addDeleted($script);
    }

    $this->addRefresh($script);
    $this->addManipulationMethods($script);

    if ($this->isAddGenericAccessors())
    {
      $this->addGetByName($script);
      $this->addGetByPosition($script);
      $this->addToArray($script);
    }

    if ($this->isAddGenericMutators())
    {
      $this->addSetByName($script);
      $this->addSetByPosition($script);
      $this->addFromArray($script);
    }

    if (!isset($this->inheritanceFk))
    {
      $this->addGetPrimaryKey($script);
      $this->addSetPrimaryKey($script);
    }

    $this->addFkMethods($script);
    $this->addRefFkMethods($script);

    if ($this->getTable()->getAttribute('isI18n'))
    {
      if (count($this->getTable()->getPrimaryKey()) > 1)
      {
        throw new Exception('i18n support only works with a single primary key');
      }

      $this->addI18nMethods($script);
    }

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $this->addAddAncestorsCriteria($script);
      $this->addAddDescendantsCriteria($script);
      $this->addUpdateNestedSet($script);
      $this->addDeleteFromNestedSet($script);
    }

    $this->addCall($script);
  }

  protected function addConstants(&$script)
  {
    $consts = array();
    foreach ($this->getTable()->getColumns() as $column)
    {
      $upperColumnName = strtoupper($column->getName());
      $consts[] = <<<EOF
    $upperColumnName = '{$this->getTable()->getName()}.$upperColumnName'
EOF;
    }
    $consts = implode(",\n", $consts);

    $script .= <<<EOF

  const
    DATABASE_NAME = '{$this->getDatabase()->getName()}',

    TABLE_NAME = '{$this->getTable()->getName()}',

$consts;

EOF;
  }

  protected function addSelectMethods(&$script)
  {
    $this->addAddSelectColumns($script);

    $this->addGetFromRow($script);

    $this->addGet($script);
    $this->addGetAll($script);
    $this->addGetOne($script);
  }

  protected function addAddSelectColumns(&$script)
  {
    $script .= <<<EOF

  public static function addSelectColumns(Criteria \$criteria)
  {

EOF;

    if (isset($this->inheritanceFk))
    {
      $foreignPeerBuilder = self::getNewPeerBuilder($this->getForeignTable($this->inheritanceFk));

      $adds = array();
      foreach ($this->inheritanceFk->getLocalForeignMapping() as $localName => $foreignName)
      {
        $adds[] = <<<EOF
    \$criteria->addJoin({$this->getColumnConstant($this->getTable()->getColumn($localName))}, {$foreignPeerBuilder->getColumnConstant($this->getForeignTable($this->inheritanceFk)->getColumn($foreignName))});
EOF;
      }
      $adds = implode("\n", $adds);

      $script .= <<<EOF
    parent::addSelectColumns(\$criteria);

$adds


EOF;
    }

    foreach ($this->getTable()->getColumns() as $column)
    {
      if ($column->isLazyLoad())
      {
        continue;
      }

      $script .= <<<EOF
    \$criteria->addSelectColumn({$this->getColumnConstant($column)});

EOF;
    }

    $script .= <<<EOF

    return \$criteria;
  }

EOF;
  }

  protected function addGetFromRow(&$script)
  {
    // Cache sub-class instances in the base class
    if (isset($this->inheritanceFk))
    {
      return;
    }

    // Object instances are indexed by primary keys.  In the case of
    // multi-table inheritance, all the primary keys are in the base table, so
    // we get the primary key values directly from the result set and possibly
    // avoid constructing a new object.  An alternative would be to construct a
    // new object, but return an old object if one existed.
    $keyComponents = array();
    foreach ($this->getTable()->getPrimaryKey() as $primaryKey)
    {
      $keyVariable = '$'.$this->getColumnVarName($primaryKey);

      $position = $primaryKey->getPosition() - 1;
      $keyComponents[] = '('.$primaryKey->getPhpType().') $row['.$position.']';
    }

    $keyExpression = $keyComponents[0];
    $args = $keyVariable;
    if (count($keyComponents) > 1)
    {
      $keyVariable = '$key';
      $keyExpression = 'serialize(array('.implode(', ', $keyComponents).'))';
      $args = implode(', ', $keyComponents);
    }

    $script .= <<<EOF

  protected static
    \${$this->getVarName(true)} = array();

  protected
    \$row = array();

  public static function getFromRow(array \$row)
  {
    if (!isset(self::\${$this->getVarName(true)}[$keyVariable = $keyExpression]))
    {

EOF;

    if (isset($this->classNameColumn))
    {
      $position = $this->classNameColumn->getPosition() - 1;
      $script .= <<<EOF
      \${$this->getVarName()} = new \$row[$position];

EOF;
    }
    else
    {
      $script .= <<<EOF
      \${$this->getVarName()} = new {$this->getObjectClassName()};

EOF;
    }

    $script .= <<<EOF
      \${$this->getVarName()}->new = false;
      \${$this->getVarName()}->row = \$row;

      self::\${$this->getVarName(true)}[$keyVariable] = \${$this->getVarName()};
    }

    return self::\${$this->getVarName(true)}[$keyVariable];
  }

EOF;
  }

  protected function addGet(&$script)
  {
    $script .= <<<EOF

  public static function get(Criteria \$criteria, array \$options = array())
  {
    if (!isset(\$options['connection']))
    {
      \$options['connection'] = Propel::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    self::addSelectColumns(\$criteria);

    return QubitQuery::createFromCriteria(\$criteria, '{$this->getObjectClassName()}', \$options);
  }

EOF;
  }

  // The following three functions can disappear from multi-table inheritance
  // children once we have late static binding.  Children must have the same
  // primary keys as the base table:
  // http://php.net/manual/en/language.oop5.late-static-bindings.php
  protected function addGetAll(&$script)
  {
    $script .= <<<EOF

  public static function getAll(array \$options = array())
  {
    return self::get(new Criteria, \$options);
  }

EOF;
  }

  protected function addGetOne(&$script)
  {
    $script .= <<<EOF

  public static function getOne(Criteria \$criteria, array \$options = array())
  {
    \$criteria->setLimit(1);

    return self::get(\$criteria, \$options)->__get(0, array('defaultValue' => null));
  }

EOF;
  }

  // Considder using getOne(), unless we drop that method.  Possibly add LIMIT
  // 1 anyway.
  protected function addRetrieveByPkMethods(&$script)
  {
    $args = array();
    $adds = array();
    foreach ($this->getTable()->getPrimaryKey() as $column)
    {
      $args[] = '$'.$this->getColumnVarName($column);
      $adds[] = <<<EOF
    \$criteria->add({$this->getColumnConstant($column)}, \${$this->getColumnVarName($column)});
EOF;
    }
    $args = implode(', ', $args);
    $adds = implode("\n", $adds);

    $script .= <<<EOF

  public static function {$this->getRetrieveMethodName()}($args, array \$options = array())
  {
    \$criteria = new Criteria;
$adds

    if (1 == count(\$query = self::get(\$criteria, \$options)))
    {
      return \$query[0];
    }
  }

EOF;
  }

  protected function addUpdateMethods(&$script)
  {
    if (!empty($this->emulateOnDeleteCascade))
    {
      $this->addDoOnDeleteCascade($script);
    }

    if (!empty($this->emulateOnDeleteSetNull))
    {
      $this->addDoOnDeleteSetNull($script);
    }

    $this->addDoDelete($script);
  }

  protected function addDoDelete(&$script)
  {
    $script .= <<<EOF

  public static function doDelete(Criteria \$criteria, \$connection = null)
  {
    if (!isset(\$connection))
    {
      \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    \$affectedRows = 0;

EOF;

    if (!empty($this->emulateOnDeleteCascade))
    {
      $script .= <<<EOF

    \$affectedRows += self::doOnDeleteCascade(\$criteria, \$connection);

EOF;
    }

    if (!empty($this->emulateOnDeleteSetNull))
    {
      $script .= <<<EOF

    \$affectedRows += self::doOnDeleteSetNull(\$criteria, \$connection);

EOF;
    }

    $script .= <<<EOF

    \$affectedRows += $this->basePeerClassName::doDelete(\$criteria, \$connection);

    return \$affectedRows;
  }

EOF;
  }

  protected function addAddOrderByPreorder(&$script)
  {
    $script .= <<<EOF

  public static function addOrderByPreorder(Criteria \$criteria, \$order = Criteria::ASC)
  {
    if (\$order == Criteria::DESC)
    {
      return \$criteria->addDescendingOrderByColumn({$this->getColumnConstant($this->nestedSetLeftColumn)});
    }

    return \$criteria->addAscendingOrderByColumn({$this->getColumnConstant($this->nestedSetLeftColumn)});
  }

EOF;
  }

  protected function addAddRootsCriteria(&$script)
  {
    $adds = array();
    foreach ($this->selfFk->getLocalColumns() as $localName)
    {
      $adds[] = <<<EOF
    \$criteria->add({$this->getColumnConstant($this->getTable()->getColumn($localName))});
EOF;
    }
    $adds = implode("\n", $adds);

    $script .= <<<EOF

  public static function addRootsCriteria(Criteria \$criteria)
  {
$adds

    return \$criteria;
  }

EOF;
  }

  protected function addConstructor(&$script)
  {
    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

  protected
    \$tables = array();

EOF;
    }

    $script .= <<<EOF

  public function __construct()
  {

EOF;

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    parent::__construct();


EOF;
    }

    if (isset($this->classNameColumn))
    {
      // Bypass __get() because tables are not yet initialized
      $script .= <<<EOF
    \$this->values['{$this->getColumnVarName($this->classNameColumn)}'] = get_class(\$this);


EOF;
    }

    $script .= <<<EOF
    \$this->tables[] = Propel::getDatabaseMap({$this->getPeerClassName()}::DATABASE_NAME)->getTable({$this->getPeerClassName()}::TABLE_NAME);
  }

EOF;
  }

  protected function addColumnMethods(&$script)
  {
    if (isset($this->inheritanceFk) && !$this->getTable()->getAttribute('isI18n') && (!isset($this->nestedSetLeftColumn) || !isset($this->nestedSetRightColumn)))
    {
      return;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

  protected
    \$values = array();

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

  protected function rowOffsetGet(\$name, \$offset)
  {
    if (array_key_exists(\$name, \$this->values))
    {
      return \$this->values[\$name];
    }

    if (!array_key_exists(\$offset, \$this->row))
    {
      if (\$this->new)
      {
        return;
      }

      \$this->refresh();
    }

    return \$this->row[\$offset];
  }

EOF;
    }

    $script .= <<<EOF

  public function __isset(\$name)
  {

EOF;

    if (isset($this->inheritanceFk) || $this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF
    \$args = func_get_args();


EOF;
    }

    if ($this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF
    \$options = array();
    if (1 < count(\$args))
    {
      \$options = \$args[1];
    }


EOF;
    }

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    if (call_user_func_array(array(\$this, 'parent::__isset'), \$args))
    {
      return true;
    }

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    \$offset = 0;
    foreach (\$this->tables as \$table)
    {
      foreach (\$table->getColumns() as \$column)
      {
        if (\$name == \$column->getPhpName())
        {
          return null !== \$this->rowOffsetGet(\$name, \$offset);
        }

        if (\$name.'Id' == \$column->getPhpName())
        {
          return null !== \$this->rowOffsetGet(\$name.'Id', \$offset);
        }

        \$offset++;
      }
    }

EOF;
    }

    if ($this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

    if (call_user_func_array(array(\$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(\$options), '__isset'), \$args))
    {
      return true;
    }

    if (!empty(\$options['cultureFallback']) && call_user_func_array(array(\$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(array('sourceCulture' => true) + \$options), '__isset'), \$args))
    {
      return true;
    }

EOF;
    }

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF

    if ('ancestors' == \$name)
    {
      return true;
    }

    if ('descendants' == \$name)
    {
      return true;
    }

EOF;
    }

    $script .= <<<EOF

    return false;
  }

EOF;

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

  public function offsetExists(\$offset)
  {
    \$args = func_get_args();

    return call_user_func_array(array(\$this, '__isset'), \$args);
  }

EOF;
    }

    $script .= <<<EOF

  public function __get(\$name)
  {

EOF;

    if (isset($this->inheritanceFk) || $this->getTable()->getAttribute('isI18n') || isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF
    \$args = func_get_args();


EOF;
    }

    if ($this->getTable()->getAttribute('isI18n') || isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF
    \$options = array();
    if (1 < count(\$args))
    {
      \$options = \$args[1];
    }


EOF;
    }

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    if (null !== \$value = call_user_func_array(array(\$this, 'parent::__get'), \$args))
    {
      return \$value;
    }

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    \$offset = 0;
    foreach (\$this->tables as \$table)
    {
      foreach (\$table->getColumns() as \$column)
      {
        if (\$name == \$column->getPhpName())
        {
          return \$this->rowOffsetGet(\$name, \$offset);
        }

        if (\$name.'Id' == \$column->getPhpName())
        {
          \$relatedTable = \$column->getTable()->getDatabaseMap()->getTable(\$column->getRelatedTableName());

          return call_user_func(array(\$relatedTable->getClassName(), 'getBy'.ucfirst(\$relatedTable->getColumn(\$column->getRelatedColumnName())->getPhpName())), \$this->rowOffsetGet(\$name.'Id', \$offset));
        }

        \$offset++;
      }
    }

EOF;
    }

    if ($this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

    if (null !== \$value = call_user_func_array(array(\$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(\$options), '__get'), \$args))
    {
      if (!empty(\$options['cultureFallback']) && 1 > strlen(\$value))
      {
        \$value = call_user_func_array(array(\$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(array('sourceCulture' => true) + \$options), '__get'), \$args);
      }

      return \$value;
    }

    if (!empty(\$options['cultureFallback']) && null !== \$value = call_user_func_array(array(\$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(array('sourceCulture' => true) + \$options), '__get'), \$args))
    {
      return \$value;
    }

EOF;
    }

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF

    if ('ancestors' == \$name)
    {
      if (!isset(\$this->values['ancestors']))
      {
        if (\$this->new)
        {
          \$this->values['ancestors'] = QubitQuery::create(array('self' => \$this) + \$options);
        }
        else
        {
          \$criteria = new Criteria;
          \$this->addAncestorsCriteria(\$criteria);
          \$this->addOrderByPreorder(\$criteria);
          \$this->values['ancestors'] = self::get(\$criteria, array('self' => \$this) + \$options);
        }
      }

      return \$this->values['ancestors'];
    }

    if ('descendants' == \$name)
    {
      if (!isset(\$this->values['descendants']))
      {
        if (\$this->new)
        {
          \$this->values['descendants'] = QubitQuery::create(array('self' => \$this) + \$options);
        }
        else
        {
          \$criteria = new Criteria;
          \$this->addDescendantsCriteria(\$criteria);
          \$this->addOrderByPreorder(\$criteria);
          \$this->values['descendants'] = self::get(\$criteria, array('self' => \$this) + \$options);
        }
      }

      return \$this->values['descendants'];
    }

EOF;
    }

    $script .= <<<EOF
  }

EOF;

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

  public function offsetGet(\$offset)
  {
    \$args = func_get_args();

    return call_user_func_array(array(\$this, '__get'), \$args);
  }

EOF;
    }

    if (!isset($this->inheritanceFk) || $this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

  public function __set(\$name, \$value)
  {
    \$args = func_get_args();

    \$options = array();
    if (2 < count(\$args))
    {
      \$options = \$args[2];
    }


EOF;
    }

    if (isset($this->inheritanceFk) && $this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF
    call_user_func_array(array(\$this, 'parent::__set'), \$args);

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    \$offset = 0;
    foreach (\$this->tables as \$table)
    {
      foreach (\$table->getColumns() as \$column)
      {
        if (\$name == \$column->getPhpName())
        {
          \$this->values[\$name] = \$value;
        }

        if (\$name.'Id' == \$column->getPhpName())
        {
          \$relatedTable = \$column->getTable()->getDatabaseMap()->getTable(\$column->getRelatedTableName());

          \$this->values[\$name.'Id'] = \$value->__get(\$relatedTable->getColumn(\$column->getRelatedColumnName())->getPhpName(), \$options);
        }

        \$offset++;
      }
    }

EOF;
    }

    if ($this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

    call_user_func_array(array(\$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(\$options), '__set'), \$args);

EOF;
    }

    if (!isset($this->inheritanceFk) || $this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

    return \$this;
  }

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

  public function offsetSet(\$offset, \$value)
  {
    \$args = func_get_args();

    return call_user_func_array(array(\$this, '__set'), \$args);
  }

EOF;
    }

    if (!isset($this->inheritanceFk) || $this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

  public function __unset(\$name)
  {

EOF;
    }

    if ($this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF
    \$args = func_get_args();

    \$options = array();
    if (1 < count(\$args))
    {
      \$options = \$args[1];
    }


EOF;
    }

    if (isset($this->inheritanceFk) && $this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF
    call_user_func_array(array(\$this, 'parent::__unset'), \$args);

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    \$offset = 0;
    foreach (\$this->tables as \$table)
    {
      foreach (\$table->getColumns() as \$column)
      {
        if (\$name == \$column->getPhpName())
        {
          \$this->values[\$name] = null;
        }

        if (\$name.'Id' == \$column->getPhpName())
        {
          \$this->values[\$name.'Id'] = null;
        }

        \$offset++;
      }
    }

EOF;
    }

    if ($this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

    call_user_func_array(array(\$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(\$options), '__unset'), \$args);

EOF;
    }

    if (!isset($this->inheritanceFk) || $this->getTable()->getAttribute('isI18n'))
    {
      $script .= <<<EOF

    return \$this;
  }

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

  public function offsetUnset(\$offset)
  {
    \$args = func_get_args();

    return call_user_func_array(array(\$this, '__unset'), \$args);
  }

EOF;
    }
  }

  protected function addNew(&$script)
  {
    $script .= <<<EOF

  protected
    \$new = true;

EOF;
  }

  protected function addDeleted(&$script)
  {
    $script .= <<<EOF

  protected
    \$deleted = false;

EOF;
  }

  protected function addRefresh(&$script)
  {
    if (isset($this->inheritanceFk))
    {
      return;
    }

    $adds = array();
    foreach ($this->getTable()->getPrimaryKey() as $column)
    {
      $adds[] = <<<EOF
    \$criteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});
EOF;
    }
    $adds = implode("\n", $adds);

    $script .= <<<EOF

  public function refresh(array \$options = array())
  {
    if (!isset(\$options['connection']))
    {
      \$options['connection'] = Propel::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    \$criteria = new Criteria;
$adds

    call_user_func(array(get_class(\$this), 'addSelectColumns'), \$criteria);

    \$statement = $this->basePeerClassName::doSelect(\$criteria, \$options['connection']);
    \$this->row = \$statement->fetch();

    return \$this;
  }

EOF;
  }

  protected function addManipulationMethods(&$script)
  {
    $this->addSave($script);
    $this->addInsert($script);
    $this->addUpdate($script);
    $this->addDelete($script);
  }

  protected function addSave(&$script)
  {
    if (isset($this->inheritanceFk) && !$this->getTable()->getAttribute('isI18n'))
    {
      return;
    }

    $script .= <<<EOF

  public function save(\$connection = null)
  {

EOF;

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    \$affectedRows = 0;

    \$affectedRows += parent::save(\$connection);

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    if (\$this->deleted)
    {
      throw new PropelException('You cannot save an object that has been deleted.');
    }

    \$affectedRows = 0;

    if (\$this->new)
    {
      \$affectedRows += \$this->insert(\$connection);
    }
    else
    {
      \$affectedRows += \$this->update(\$connection);
    }

    \$offset = 0;
    foreach (\$this->tables as \$table)
    {
      foreach (\$table->getColumns() as \$column)
      {
        if (array_key_exists(\$column->getPhpName(), \$this->values))
        {
          \$this->row[\$offset] = \$this->values[\$column->getPhpName()];
        }

        \$offset++;
      }
    }

    \$this->new = false;
    \$this->values = array();

EOF;
    }

    if ($this->getTable()->getAttribute('isI18n'))
    {
      $foreignPeerBuilder = self::getNewPeerBuilder($this->i18nFk->getTable());

      $sets = array();
      foreach ($this->i18nFk->getLocalForeignMapping() as $localName => $foreignName)
      {
        $sets[] = <<<EOF
      \${$foreignPeerBuilder->getVarName()}->set{$this->i18nFk->getTable()->getColumn($localName)->getPhpName()}(\$this->{$this->getColumnVarName($this->getTable()->getColumn($foreignName))});
EOF;
      }
      $sets = implode("\n", $sets);

      $script .= <<<EOF

    foreach (\$this->{$this->getRefFkCollVarName($this->i18nFk)} as \${$foreignPeerBuilder->getVarName()})
    {
$sets

      \$affectedRows += \${$foreignPeerBuilder->getVarName()}->save(\$connection);
    }

EOF;
    }

    $script .= <<<EOF

    return \$affectedRows;
  }

EOF;
  }

  protected function addInsert(&$script)
  {
    if (isset($this->inheritanceFk) && (!isset($this->nestedSetLeftColumn) || !isset($this->nestedSetRightColumn)))
    {
      return;
    }

    $script .= <<<EOF

  protected function insert(\$connection = null)
  {
    \$affectedRows = 0;

EOF;

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF

    \$this->updateNestedSet(\$connection);

EOF;
    }

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF

    \$affectedRows += parent::insert(\$connection);

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

    if (!isset(\$connection))
    {
      \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    \$offset = 0;
    foreach (\$this->tables as \$table)
    {
      \$criteria = new Criteria;
      foreach (\$table->getColumns() as \$column)
      {
        if (!array_key_exists(\$column->getPhpName(), \$this->values))
        {
          if ('createdAt' == \$column->getPhpName() || 'updatedAt' == \$column->getPhpName())
          {
            \$this->values[\$column->getPhpName()] = new DateTime;
          }

          if ('sourceCulture' == \$column->getPhpName())
          {
            \$this->values['sourceCulture'] = sfPropel::getDefaultCulture();
          }
        }

        if (array_key_exists(\$column->getPhpName(), \$this->values))
        {
          \$criteria->add(\$column->getFullyQualifiedName(), \$this->values[\$column->getPhpName()]);
        }

        \$offset++;
      }

      if (null !== \$id = $this->basePeerClassName::doInsert(\$criteria, \$connection))
      {
        // Guess that the first primary key of the first table is auto-incremented
        if (\$this->tables[0] == \$table)
        {
          \$columns = \$table->getPrimaryKeyColumns();
          \$this->values[\$columns[0]->getPhpName()] = \$id;
        }
      }

      \$affectedRows += 1;
    }

EOF;
    }

    $script .= <<<EOF

    return \$affectedRows;
  }

EOF;
  }

  protected function addUpdate(&$script)
  {
    if (isset($this->inheritanceFk) && (!isset($this->nestedSetLeftColumn) || !isset($this->nestedSetRightColumn)))
    {
      return;
    }

    $script .= <<<EOF

  protected function update(\$connection = null)
  {
    \$affectedRows = 0;

EOF;

    // TODO: Only update nested set if the self foreign key has changed
    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF

    \/\/ Update nested set keys only if parent id has changed
    if (isset(\$this->values['parentId']))
    {
      \/\/ Get the "original" parentId before any updates
      \$offset = 0; 
      \$originalParentId = null;
      foreach (\$this->tables as \$table)
      {
        foreach (\$table->getColumns() as \$column)
        {
          if ('parentId' == \$column->getPhpName())
          {
            \$originalParentId = \$this->row[\$offset];
            break;
          }
          \$offset++;
        }
      }
      
      \/\/ If updated value of parentId is different then original value,
      \/\/ update the nested set
      if (\$originalParentId != \$this->values['parentId'])
      {
        \$this->updateNestedSet(\$connection);
      }
    }

EOF;
    }

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF

    \$affectedRows += parent::update(\$connection);

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $script .= <<<EOF

    if (!isset(\$connection))
    {
      \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    \$offset = 0;
    foreach (\$this->tables as \$table)
    {
      \$criteria = new Criteria;
      \$selectCriteria = new Criteria;
      foreach (\$table->getColumns() as \$column)
      {
        if (!array_key_exists(\$column->getPhpName(), \$this->values))
        {
          if ('updatedAt' == \$column->getPhpName())
          {
            \$this->values['updatedAt'] = new DateTime;
          }
        }

        if (array_key_exists(\$column->getPhpName(), \$this->values))
        {
          \$criteria->add(\$column->getFullyQualifiedName(), \$this->values[\$column->getPhpName()]);
        }

        if (\$column->isPrimaryKey())
        {
          \$selectCriteria->add(\$column->getFullyQualifiedName(), \$this->row[\$offset]);
        }

        \$offset++;
      }

      if (\$criteria->size() > 0)
      {
        \$affectedRows += $this->basePeerClassName::doUpdate(\$selectCriteria, \$criteria, \$connection);
      }
    }

EOF;
    }

    $script .= <<<EOF

    return \$affectedRows;
  }

EOF;
  }

  protected function addDelete(&$script)
  {
    // If this class is not the base of an object hierarchy and it does not
    // contain any nested set behavior, then this method does nothing except
    // call the parent class' implementation.
    if (isset($this->inheritanceFk) && (!isset($this->nestedSetLeftColumn) || !isset($this->nestedSetRightColumn)))
    {
      return;
    }

    $script .= <<<EOF

  public function delete(\$connection = null)
  {
    if (\$this->deleted)
    {
      throw new PropelException('This object has already been deleted.');
    }

    \$affectedRows = 0;

EOF;

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF

    \$this->refresh(array('connection' => \$connection));
    \$this->deleteFromNestedSet(\$connection);

EOF;
    }

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF

    \$affectedRows += parent::delete(\$connection);

EOF;
    }

    if (!isset($this->inheritanceFk))
    {
      $adds = array();
      foreach ($this->getTable()->getPrimaryKey() as $column)
      {
        $adds[] = <<<EOF
    \$criteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});
EOF;
      }
      $adds = implode("\n", $adds);

      $script .= <<<EOF

    \$criteria = new Criteria;
$adds

    \$affectedRows += self::doDelete(\$criteria, \$connection);

    \$this->deleted = true;

EOF;
    }

    $script .= <<<EOF

    return \$affectedRows;
  }

EOF;
  }

  public function getFkPhpName(ForeignKey $fk)
  {
    if (count($localNames = $fk->getLocalColumns()) < 2 && '_id' == substr($localNames[0], -3))
    {
      return substr($this->getTable()->getColumn($localNames[0])->getPhpName(), 0, -2);
    }

    return $this->getFkPhpNameAffix($fk);
  }

  public function getFkVarName(ForeignKey $fk)
  {
    return strtolower(substr($phpName = $this->getFkPhpName($fk), 0, 1)).substr($phpName, 1);
  }

  public function getRefFkCollVarName(ForeignKey $refFk)
  {
    return strtolower(substr($phpName = $this->getRefFkPhpNameAffix($refFk, true), 0, 1)).substr($phpName, 1);
  }

  protected function addFkMethods(&$script)
  {
    foreach ($this->getTable()->getForeignKeys() as $fk)
    {
      if ($fk == $this->inheritanceFk)
      {
        continue;
      }

      $this->addFkAddJoinCriteria($script, $fk);
    }
  }

  protected function addFkAddJoinCriteria(&$script, ForeignKey $fk)
  {
    $foreignPeerBuilder = self::getNewPeerBuilder($this->getForeignTable($fk));

    $adds = array();
    foreach ($fk->getLocalForeignMapping() as $localName => $foreignName)
    {
      $adds[] = <<<EOF
    \$criteria->addJoin({$this->getColumnConstant($this->getTable()->getColumn($localName))}, {$foreignPeerBuilder->getColumnConstant($this->getForeignTable($fk)->getColumn($foreignName))});
EOF;
    }
    $adds = implode("\n", $adds);

    $script .= <<<EOF

  public static function addJoin{$this->getFkPhpName($fk)}Criteria(Criteria \$criteria)
  {
$adds

    return \$criteria;
  }

EOF;
  }

  protected function addRefFkMethods(&$script)
  {
    foreach ($this->getTable()->getReferrers() as $refFk)
    {
      $foreignPeerBuilder = self::getNewPeerBuilder($refFk->getTable());

      if ($refFk == $foreignPeerBuilder->inheritanceFk)
      {
        continue;
      }

      $this->addRefFkAddCriteriaById($script, $refFk);
      $this->addRefFkGetById($script, $refFk);
      $this->addRefFkAddCriteria($script, $refFk);
      $this->addRefFkAttributes($script, $refFk);
      $this->addRefFkGet($script, $refFk);
    }
  }

  protected function addRefFkAddCriteriaById(&$script, ForeignKey $refFk)
  {
    $foreignPeerBuilder = self::getNewPeerBuilder($refFk->getTable());

    $args = array();
    $adds = array();
    foreach ($refFk->getLocalForeignMapping() as $localName => $foreignName)
    {
      $args[] = '$'.$foreignName;
      $adds[] = <<<EOF
    \$criteria->add({$foreignPeerBuilder->getColumnConstant($refFk->getTable()->getColumn($localName))}, \$$foreignName);
EOF;
    }
    $args = implode(', ', $args);
    $adds = implode("\n", $adds);

    $script .= <<<EOF

  public static function add{$this->getRefFkPhpNameAffix($refFk, true)}CriteriaById(Criteria \$criteria, $args)
  {
$adds

    return \$criteria;
  }

EOF;
  }

  protected function addRefFkGetById(&$script, ForeignKey $refFk)
  {
    $foreignPeerBuilder = self::getNewPeerBuilder($refFk->getTable());

    $args = array();
    foreach ($refFk->getForeignColumns() as $foreignName)
    {
      $args[] = '$'.$foreignName;
    }
    $args = implode(', ', $args);

    $script .= <<<EOF

  public static function get{$this->getRefFkPhpNameAffix($refFk, true)}ById($args, array \$options = array())
  {
    \$criteria = new Criteria;
    self::add{$this->getRefFkPhpNameAffix($refFk, true)}CriteriaById(\$criteria, $args);

    return {$foreignPeerBuilder->getPeerClassName()}::get(\$criteria, \$options);
  }

EOF;
  }

  protected function addRefFkAddCriteria(&$script, ForeignKey $refFk)
  {
    $args = array();
    foreach ($refFk->getForeignColumns() as $foreignName)
    {
      $args[] = '$this->'.$foreignName;
    }
    $args = implode(', ', $args);

    $script .= <<<EOF

  public function add{$this->getRefFkPhpNameAffix($refFk, true)}Criteria(Criteria \$criteria)
  {
    return self::add{$this->getRefFkPhpNameAffix($refFk, true)}CriteriaById(\$criteria, $args);
  }

EOF;
  }

  protected function addRefFkAttributes(&$script, ForeignKey $refFk)
  {
    $script .= <<<EOF

  protected
    \${$this->getRefFkCollVarName($refFk)} = null;

EOF;
  }

  protected function addRefFkGet(&$script, ForeignKey $refFk)
  {
    $args = array();
    $conds = array();
    foreach ($localForeignMap = $refFk->getLocalForeignMapping() as $localName => $foreignName)
    {
      $args[] = '$this->'.$foreignName;
      $conds[] = '!isset($this->'.$foreignName.')';
    }
    $args = implode(', ', $args);
    $conds = implode(' || ', $conds);

    $script .= <<<EOF

  public function get{$this->getRefFkPhpNameAffix($refFk, true)}(array \$options = array())
  {
    if (!isset(\$this->{$this->getRefFkCollVarName($refFk)}))
    {
      if ($conds)
      {
        \$this->{$this->getRefFkCollVarName($refFk)} = QubitQuery::create();
      }
      else
      {
        \$this->{$this->getRefFkCollVarName($refFk)} = self::get{$this->getRefFkPhpNameAffix($refFk, true)}ById($args, array('self' => \$this) + \$options);
      }
    }

    return \$this->{$this->getRefFkCollVarName($refFk)};
  }

EOF;
  }

  protected function addI18nMethods(&$script)
  {
    $foreignPeerBuilder = self::getNewPeerBuilder($this->i18nFk->getTable());

    $args = array();
    foreach ($this->getTable()->getPrimaryKey() as $column)
    {
      $args[] = '$this->'.$this->getColumnVarName($column);
    }
    $args = implode(', ', $args);

    $script .= <<<EOF

  public function getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(array \$options = array())
  {
    if (!empty(\$options['sourceCulture']))
    {
      \$options['culture'] = \$this->{$this->getColumnVarName($this->sourceCultureColumn)};
    }

    if (!isset(\$options['culture']))
    {
      \$options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset(\$this->{$this->getRefFkCollVarName($this->i18nFk)}[\$options['culture']]))
    {
      if (!isset($args) || null === \${$foreignPeerBuilder->getVarName()} = {$foreignPeerBuilder->getPeerClassName()}::{$foreignPeerBuilder->getRetrieveMethodName()}($args, \$options['culture'], \$options))
      {
        \${$foreignPeerBuilder->getVarName()} = new {$foreignPeerBuilder->getObjectClassName()};
        \${$foreignPeerBuilder->getVarName()}->set{$foreignPeerBuilder->cultureColumn->getPhpName()}(\$options['culture']);
      }
      \$this->{$this->getRefFkCollVarName($this->i18nFk)}[\$options['culture']] = \${$foreignPeerBuilder->getVarName()};
    }

    return \$this->{$this->getRefFkCollVarName($this->i18nFk)}[\$options['culture']];
  }

EOF;
  }

  protected function addAddAncestorsCriteria(&$script)
  {
    $script .= <<<EOF

  public function addAncestorsCriteria(Criteria \$criteria)
  {
    return \$criteria->add({$this->getColumnConstant($this->nestedSetLeftColumn)}, \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}, Criteria::LESS_THAN)->add({$this->getColumnConstant($this->nestedSetRightColumn)}, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)}, Criteria::GREATER_THAN);
  }

EOF;
  }

  protected function addAddDescendantsCriteria(&$script)
  {
    $script .= <<<EOF

  public function addDescendantsCriteria(Criteria \$criteria)
  {
    return \$criteria->add({$this->getColumnConstant($this->nestedSetLeftColumn)}, \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}, Criteria::GREATER_THAN)->add({$this->getColumnConstant($this->nestedSetRightColumn)}, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)}, Criteria::LESS_THAN);
  }

EOF;
  }

  protected function addUpdateNestedSet(&$script)
  {
    $script .= <<<EOF

  protected function updateNestedSet(\$connection = null)
  {
// HACK: Try to prevent modifying left and right values anywhere except in this
// method.  Perhaps it would be more logical to use protected visibility for
// these values?
unset(\$this->values['{$this->getColumnVarName($this->nestedSetLeftColumn)}']);
unset(\$this->values['{$this->getColumnVarName($this->nestedSetRightColumn)}']);
    if (!isset(\$connection))
    {
      \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    if (!isset(\$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}) || !isset(\$this->{$this->getColumnVarName($this->nestedSetRightColumn)}))
    {
      \$delta = 2;
    }
    else
    {
      \$delta = \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} - \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} + 1;
    }

    if (null === \${$this->getFkVarName($this->selfFk)} = \$this->__get('{$this->getFkPhpName($this->selfFk)}', array('connection' => \$connection)))
    {
      \$statement = \$connection->prepare('
        SELECT MAX('.{$this->getColumnConstant($this->nestedSetRightColumn)}.')
        FROM '.{$this->getPeerClassName()}::TABLE_NAME);
      \$statement->execute();
      \$row = \$statement->fetch();
      \$max = \$row[0];

      if (!isset(\$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}) || !isset(\$this->{$this->getColumnVarName($this->nestedSetRightColumn)}))
      {
        \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} = \$max + 1;
        \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} = \$max + 2;

        return \$this;
      }

      \$shift = \$max + 1 - \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)};
    }
    else
    {
      \$parent->refresh(array('connection' => \$connection));

      if (isset(\$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}) && isset(\$this->{$this->getColumnVarName($this->nestedSetRightColumn)}) && \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} <= \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetLeftColumn)} && \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} >= \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)})
      {
        throw new PropelException('An object cannot be a descendant of itself.');
      }

      \$statement = \$connection->prepare('
        UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
        SET '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' = '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' + ?
        WHERE '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' >= ?');
      \$statement->execute(array(\$delta, \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)}));

      \$statement = \$connection->prepare('
        UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
        SET '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' = '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' + ?
        WHERE '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' >= ?');
      \$statement->execute(array(\$delta, \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)}));

      if (!isset(\$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}) || !isset(\$this->{$this->getColumnVarName($this->nestedSetRightColumn)}))
      {
        \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} = \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)};
        \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} = \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)} + 1;

        return \$this;
      }

      if (\$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} > \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)})
      {
        \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} += \$delta;
        \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} += \$delta;
      }

      \$shift = \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)} - \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)};
    }

    \$statement = \$connection->prepare('
      UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
      SET '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' = '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' + ?, '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' = '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' + ?
      WHERE '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' >= ?
      AND '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' <= ?');
    \$statement->execute(array(\$shift, \$shift, \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)}));

    \$this->deleteFromNestedSet(\$connection);

    if (\$shift > 0)
    {
      \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} -= \$delta;
      \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} -= \$delta;
    }

    \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} += \$shift;
    \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} += \$shift;

    return \$this;
  }

EOF;
  }

  protected function addDeleteFromNestedSet(&$script)
  {
    $script .= <<<EOF

  protected function deleteFromNestedSet(\$connection = null)
  {
    if (!isset(\$connection))
    {
      \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    \$delta = \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} - \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} + 1;

    \$statement = \$connection->prepare('
      UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
      SET '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' = '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' - ?
      WHERE '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' >= ?');
    \$statement->execute(array(\$delta, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)}));

    \$statement = \$connection->prepare('
      UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
      SET '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' = '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' - ?
      WHERE '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' >= ?');
    \$statement->execute(array(\$delta, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)}));

    return \$this;
  }

EOF;
  }

  protected function addCall(&$script)
  {
    if (isset($this->inheritanceFk))
    {
      return;
    }

    $script .= <<<EOF

  public function __call(\$name, \$args)
  {
    if ('get' == substr(\$name, 0, 3) || 'set' == substr(\$name, 0, 3))
    {
      \$args = array_merge(array(strtolower(substr(\$name, 3, 1)).substr(\$name, 4)), \$args);

      return call_user_func_array(array(\$this, '__'.substr(\$name, 0, 3)), \$args);
    }

    throw new sfException('Call to undefined method '.get_class(\$this).'::'.\$name);
  }

EOF;
  }

  protected function addClassClose(&$script)
  {
    $script .= <<<EOF
}

EOF;
  }
}
