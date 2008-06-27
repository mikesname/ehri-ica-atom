<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

require_once 'propel/engine/builder/om/PeerBuilder.php';

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
    $this->basePeerClassName = $this->className($this->getBasePeer($table));

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
    return $this->getBuildProperty('basePrefix').$this->getTable()->getPhpName();
  }

  protected function getColumnVarName(Column $column)
  {
    return strtolower(substr($name = $column->getPhpName(), 0, 1)).substr($name, 1);
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
      $names[] = $column->getPhpName();
    }

    return 'getBy'.implode($names, 'And');
  }

  protected function getVarName($plural = null)
  {
    $name = strtolower(substr($name = $this->getTable()->getPhpName(), 0, 1)).substr($name, 1);
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
      $extends = ' extends '.ClassTools::className($baseClass);
    }

    $script .= <<<EOF

abstract class {$this->getClassName()}$extends$implements
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

    $this->addColumnMethods($script);

    if (!isset($this->inheritanceFk))
    {
      $this->addNew($script);
      $this->addDeleted($script);
      $this->addColumnModified($script);
    }

    $this->addResetModified($script);

    $this->addHydrate($script);
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

    if (DataModelBuilder::getBuildProperty('builderAddBehaviors'))
    {
      $this->addCall($script);
    }

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $this->addAddAncestorsCriteria($script);
      $this->addAncestorsAttributes($script);
      $this->addGetAncestors($script);
      $this->addAddDescendantsCriteria($script);
      $this->addDescendantsAttributes($script);
      $this->addGetDescendants($script);
      $this->addUpdateNestedSet($script);
      $this->addDeleteFromNestedSet($script);
    }
  }

  protected function addConstants(&$script)
  {
    $script .= <<<EOF

  const DATABASE_NAME = '{$this->getDatabase()->getName()}';

  const TABLE_NAME = '{$this->getTable()->getName()}';


EOF;

    $this->addColumnNameConstants(&$script);
  }

  protected function addColumnNameConstants(&$script)
  {
    foreach ($this->getTable()->getColumns() as $column)
    {
      $upperColumnName = strtoupper($column->getName());

      $script .= <<<EOF
  const $upperColumnName = '{$this->getTable()->getName()}.$upperColumnName';

EOF;
    }
  }

  protected function addSelectMethods(&$script)
  {
    $this->addAddSelectColumns($script);

    $this->addGetFromResultSet($script);

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

  protected function addCount(&$script)
  {
    $script .= <<<EOF

  public static function count(Criteria \$criteria, array \$options = array())
  {
    if (!isset(\$options['connection']))
    {
      \$options['connection'] = Propel::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    \$criteria->addSelectColumn('COUNT(*)');
    \$results = {$this->basePeerClassName}::doSelect(\$criteria, \$options['connection']);
    \$results->next();

    return \$results->getInt(1);
  }

EOF;
  }

  protected function addGetFromResultSet(&$script)
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
      $keyComponents[] = '$resultSet->get'.CreoleTypes::getAffix(CreoleTypes::getCreoleCode($primaryKey->getType())).'('.$primaryKey->getPosition().')';
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

  protected static \${$this->getVarName(true)} = array();

  public static function getFromResultSet(ResultSet \$resultSet)
  {
    if (!isset(self::\${$this->getVarName(true)}[$keyVariable = $keyExpression]))
    {

EOF;

    // In the case of multi-table inheritance, class names are stored in the
    // database.  This is currently quite a hack.  Hopefully the object is a
    // super class of the table we queried.  If it is not, then the result set
    // will not contain enough columns, resulting in an SQLExcetion.  In that
    // case we do another query to get all the required columns.  This needs
    // optimization.
    if (isset($this->classNameColumn))
    {
      $affix = CreoleTypes::getAffix(CreoleTypes::getCreoleCode($this->classNameColumn->getType()));

      $script .= <<<EOF
      \$className = \$resultSet->get$affix({$this->classNameColumn->getPosition()});
      \${$this->getVarname()} = new \$className;

      try
      {
        \${$this->getVarName()}->hydrate(\$resultSet);
      }
      catch (SQLException \$e)
      {
        return call_user_func(array(\$className, '{$this->getRetrieveMethodName()}'), $args);
      }

EOF;
    }
    else
    {
      $script .= <<<EOF
      \${$this->getVarName()} = new {$this->getObjectClassName()};
      \${$this->getVarName()}->hydrate(\$resultSet);

EOF;
    }

    $script .= <<<EOF

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

    return self::get(\$criteria, \$options)->offsetGet(0, array('defaultValue' => null));
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

    return self::get(\$criteria, \$options)->offsetGet(0, array('defaultValue' => null));
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

    \$affectedRows += {$this->basePeerClassName}::doDelete(\$criteria, \$connection);

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

  protected function addColumnMethods(&$script)
  {
    foreach ($this->getTable()->getColumns() as $column)
    {
      if (isset($this->inheritanceFk))
      {
        $localForeignMap = $this->inheritanceFk->getLocalForeignMapping();
        if (isset($localForeignMap[$column->getName()]))
        {
          continue;
        }
      }

      if (null !== $default = $column->getPhpDefaultValue())
      {
        $default = var_export($default, true);
      }
      else
      {
        $default = 'null';
      }

      $script .= <<<EOF

  protected \${$this->getColumnVarName($column)} = $default;

EOF;

      if ($column->getType() == PropelTypes::DATE || $column->getType() == PropelTypes::TIME || $column->getType() == PropelTypes::TIMESTAMP)
      {
        $this->addTemporalAccessor($script, $column);
        $this->addTemporalMutator($script, $column);
      }
      else
      {
        $this->addGenericAccessor($script, $column);
        $this->addDefaultMutator($script, $column);
      }
    }
  }

  protected function addGenericAccessor(&$script, Column $column)
  {
    if ($column == $this->nestedSetLeftColumn || $column == $this->nestedSetRightColumn)
    {
      //return;
    }

    $script .= <<<EOF

  public function get{$column->getPhpName()}()
  {
    return \$this->{$this->getColumnVarName($column)};
  }

EOF;
  }

  protected function addTemporalAccessor(&$script, Column $column)
  {
    $script .= <<<EOF

  public function get{$column->getPhpName()}(array \$options = array())
  {

EOF;

    $default = null;
    switch ($column->getType())
    {
      case PropelTypes::DATE:
        $default = $this->getBuildProperty('defaultDateFormat');
        break;

      case PropelTypes::TIME:
        $default = $this->getBuildProperty('defaultTimeFormat');
        break;

      case PropelTypes::TIMESTAMP:
        $default = $this->getBuildProperty('defaultTimeStampFormat');
        break;
    }

    if (isset($default))
    {
      $script .= <<<EOF
    \$options += array('format' => '$default');

EOF;
    }

    $script .= <<<EOF
    if (isset(\$options['format']))
    {
      return date(\$options['format'], \$this->{$this->getColumnVarName($column)});
    }

    return \$this->{$this->getColumnVarName($column)};
  }

EOF;
  }

  protected function addDefaultMutator(&$script, Column $column)
  {
    $this->addMutatorOpen($script, $column);

    $script .= <<<EOF
    \$this->{$this->getColumnVarName($column)} = \${$this->getColumnVarName($column)};

EOF;

    $this->addMutatorClose($script, $column);
  }

  protected function addTemporalMutator(&$script, Column $column)
  {
    $this->addMutatorOpen($script, $column);

    $script .= <<<EOF
    if (is_string(\${$this->getColumnVarName($column)}) && false === \${$this->getColumnVarName($column)} = strtotime(\${$this->getColumnVarName($column)}))
    {
      throw new PropelException('Unable to parse date / time value for [{$this->getColumnVarName($column)}] from input: '.var_export(\${$this->getColumnVarName($column)}, true));
    }

    \$this->{$this->getColumnVarName($column)} = \${$this->getColumnVarName($column)};

EOF;

    $this->addMutatorClose($script, $column);
  }

  protected function addMutatorOpen(&$script, Column $column)
  {
    $visibility = 'public';
    if ($column == $this->nestedSetLeftColumn || $column == $this->nestedSetRightColumn)
    {
      $visibility = 'protected';
    }

    $script .= <<<EOF

  $visibility function set{$column->getPhpName()}(\${$this->getColumnVarName($column)})
  {

EOF;
  }

  protected function addMutatorClose(&$script, Column $column)
  {
    $script .= <<<EOF

    return \$this;
  }

EOF;
  }

  protected function addNew(&$script)
  {
    $script .= <<<EOF

  protected \$new = true;

EOF;
  }

  protected function addDeleted(&$script)
  {
    $script .= <<<EOF

  protected \$deleted = false;

EOF;
  }

  protected function addColumnModified(&$script)
  {
    $script .= <<<EOF

  protected \$columnValues = null;

  protected function isColumnModified(\$name)
  {
    return \$this->\$name != \$this->columnValues[\$name];
  }

EOF;
  }

  protected function addResetModified(&$script)
  {
    $sets = array();
    foreach ($this->getTable()->getColumns() as $column)
    {
      $sets[] = <<<EOF
    \$this->columnValues['{$this->getColumnVarName($column)}'] = \$this->{$this->getColumnVarName($column)};
EOF;
    }
    $sets = implode("\n", $sets);

    $script .= <<<EOF

  protected function resetModified()
  {

EOF;

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    parent::resetModified();


EOF;
    }

    $script .= <<<EOF
$sets

    return \$this;
  }

EOF;
  }

  protected function addHydrate(&$script)
  {
    $script .= <<<EOF

  public function hydrate(ResultSet \$results, \$columnOffset = 1)
  {

EOF;

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF
    \$columnOffset = parent::hydrate(\$results, \$columnOffset);


EOF;
    }

    foreach ($this->getTable()->getColumns() as $column)
    {
      if ($column->isLazyLoad())
      {
        continue;
      }

      $affix = CreoleTypes::getAffix(CreoleTypes::getCreoleCode($column->getType()));

      $args = array();
      $args[] = '$columnOffset++';

      // Hack to prevent Creole from formatting timestamps as strings
      if ($column->getType() == PropelTypes::TIMESTAMP)
      {
        $args[] = 'null';
      }
      $args = implode(', ', $args);

      $script .= <<<EOF
    \$this->{$this->getColumnVarName($column)} = \$results->get$affix($args);

EOF;
    }

    $script .= <<<EOF

    \$this->new = false;
    \$this->resetModified();

    return \$columnOffset;
  }

EOF;
  }

  protected function addRefresh(&$script)
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

  public function refresh(array \$options = array())
  {
    if (!isset(\$options['connection']))
    {
      \$options['connection'] = Propel::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    \$criteria = new Criteria;
$adds

    self::addSelectColumns(\$criteria);

    \$resultSet = {$this->basePeerClassName}::doSelect(\$criteria, \$options['connection']);
    \$resultSet->next();

    return \$this->hydrate(\$resultSet);
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
    if (!isset($this->inheritanceFk) || $this->getTable()->getAttribute('isI18n'))
    {
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
      else
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

    \$this->new = false;
    \$this->resetModified();

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
  }

  protected function addInsert(&$script)
  {
    $adds = array();
    foreach ($this->getTable()->getColumns() as $column)
    {
      if ($column->getName() == 'created_at' || $column->getName() == 'updated_at')
      {
        $adds[] = <<<EOF
    if (!\$this->isColumnModified('{$this->getColumnVarName($column)}'))
    {
      \$this->{$this->getColumnVarName($column)} = time();
    }
    \$criteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});
EOF;

        continue;
      }

      if ($column->getName() == 'source_culture')
      {
        $adds[] = <<<EOF
    if (!\$this->isColumnModified('{$this->getColumnVarName($column)}'))
    {
      \$this->{$this->getColumnVarName($column)} = sfPropel::getDefaultCulture();
    }
    \$criteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});
EOF;

        continue;
      }

      $adds[] = <<<EOF
    if (\$this->isColumnModified('{$this->getColumnVarName($column)}'))
    {
      \$criteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});
    }
EOF;
    }
    $adds = implode("\n\n", $adds);

    $script .= <<<EOF

  protected function insert(\$connection = null)
  {
    \$affectedRows = 0;

EOF;

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF

    \$affectedRows += parent::insert(\$connection);

EOF;
    }

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $script .= <<<EOF

    \$this->updateNestedSet(\$connection);

EOF;
    }

    $script .= <<<EOF

    \$criteria = new Criteria;

$adds

    if (!isset(\$connection))
    {
      \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

EOF;

    if ($this->getTable()->getIdMethod() == IDMethod::NO_ID_METHOD)
    {
        $script .= <<<EOF

    {$this->basePeerClassName}::doInsert(\$criteria, \$connection);

EOF;
    }
    else
    {
        $script .= <<<EOF

    \$id = {$this->basePeerClassName}::doInsert(\$criteria, \$connection);

EOF;
      foreach ($this->getTable()->getPrimaryKey() as $column)
      {
        if ($column->isAutoIncrement())
        {
          $script .= <<<EOF
    \$this->{$this->getColumnVarName($column)} = \$id;

EOF;
        }
      }
    }

    $script .= <<<EOF
    \$affectedRows += 1;

    return \$affectedRows;
  }

EOF;
  }

  protected function addUpdate(&$script)
  {
    $adds = array();
    foreach ($this->getTable()->getColumns() as $column)
    {
      if ($column->getName() == 'updated_at')
      {
        $adds[] = <<<EOF
    if (!\$this->isColumnModified('{$this->getColumnVarName($column)}'))
    {
      \$this->{$this->getColumnVarName($column)} = time();
    }
    \$criteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});
EOF;

        continue;
      }

      $adds[] = <<<EOF
    if (\$this->isColumnModified('{$this->getColumnVarName($column)}'))
    {
      \$criteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});
    }
EOF;
    }
    $adds = implode("\n\n", $adds);

    $script .= <<<EOF

  protected function update(\$connection = null)
  {
    \$affectedRows = 0;

EOF;

    if (isset($this->inheritanceFk))
    {
      $script .= <<<EOF

    \$affectedRows += parent::update(\$connection);

EOF;
    }

    if (isset($this->nestedSetLeftColumn) && isset($this->nestedSetRightColumn))
    {
      $conds = array();
      foreach ($this->selfFk->getLocalColumns() as $localName)
      {
        $conds[] = '$this->isColumnModified(\''.$this->getColumnVarName($this->getTable()->getColumn($localName)).'\')';
      }
      $conds = implode(' || ', $conds);

      $script .= <<<EOF

    if ($conds)
    {
      \$this->updateNestedSet(\$connection);
    }

EOF;
    }

    $script .= <<<EOF

    \$criteria = new Criteria;

$adds

    if (\$criteria->size() > 0)
    {
      \$selectCriteria = new Criteria;

EOF;

    foreach ($this->getTable()->getPrimaryKey() as $column)
    {
      $script .= <<<EOF
      \$selectCriteria->add({$this->getColumnConstant($column)}, \$this->{$this->getColumnVarName($column)});

EOF;
    }

    $script .= <<<EOF

      if (!isset(\$connection))
      {
        \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
      }

      \$affectedRows += {$this->basePeerClassName}::doUpdate(\$selectCriteria, \$criteria, \$connection);
    }

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
    else
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
    if (count($localNames = $fk->getLocalColumns()) != 1 || substr($localNames[0], -3) != '_id')
    {
      return $this->getFkPhpNameAffix($fk);
    }

    return sfInflector::camelize(substr($localNames[0], 0, -3));
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
      $this->addFkAccessor($script, $fk);
      $this->addFkMutator($script, $fk);
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

  protected function addFkAccessor(&$script, ForeignKey $fk)
  {
    $args = array();
    foreach ($fk->getLocalColumns() as $localName)
    {
      $args[] = '$this->'.$this->getColumnVarName($this->getTable()->getColumn($localName));
    }
    $args = implode(', ', $args);

    $foreignPeerBuilder = self::getNewPeerBuilder($this->getForeignTable($fk));

    $script .= <<<EOF

  public function get{$this->getFkPhpName($fk)}(array \$options = array())
  {
    return \$this->{$this->getFkVarName($fk)} = {$foreignPeerBuilder->getPeerClassName()}::{$foreignPeerBuilder->getRetrieveMethodName()}($args, \$options);
  }

EOF;
  }

  // TODO: Consider dropping the foreign key mutator because foreign objects
  // are now cached in the foreign class and indexed by primary key
  protected function addFkMutator(&$script, ForeignKey $fk)
  {
    $foreignPeerBuilder = self::getNewPeerBuilder($this->getForeignTable($fk));

    $sets = array();
    foreach ($fk->getLocalForeignMapping() as $localName => $foreignName)
    {
      $sets[] = <<<EOF
    \$this->{$this->getColumnVarName($this->getTable()->getColumn($localName))} = \${$foreignPeerBuilder->getVarName()}->get{$this->getForeignTable($fk)->getColumn($foreignName)->getPhpName()}();
EOF;
    }
    $sets = implode("\n", $sets);

    $script .= <<<EOF

  public function set{$this->getFkPhpName($fk)}({$foreignPeerBuilder->getObjectClassName()} \${$foreignPeerBuilder->getVarName()})
  {
$sets

    return \$this;
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

  protected \${$this->getRefFkCollVarName($refFk)} = null;

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

    foreach ($this->i18nFk->getTable()->getColumns() as $column)
    {
      if ($column->isPrimaryKey())
      {
        continue;
      }

      $script .= <<<EOF

  public function get{$column->getPhpName()}(array \$options = array())
  {
    \${$this->getColumnVarName($column)} = \$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(\$options)->get{$column->getPhpName()}();
    if (!empty(\$options['cultureFallback']) && strlen(\${$this->getColumnVarName($column)}) < 1)
    {
      \${$this->getColumnVarName($column)} = \$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(array('sourceCulture' => true) + \$options)->get{$column->getPhpName()}();
    }

    return \${$this->getColumnVarName($column)};
  }

  public function set{$column->getPhpName()}(\$value, array \$options = array())
  {
    \$this->getCurrent{$this->getRefFkPhpNameAffix($this->i18nFk)}(\$options)->set{$column->getPhpName()}(\$value);

    return \$this;
  }

EOF;
    }

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
      if (null === \${$foreignPeerBuilder->getVarName()} = {$foreignPeerBuilder->getPeerClassName()}::{$foreignPeerBuilder->getRetrieveMethodName()}($args, \$options['culture'], \$options))
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

  protected function addAncestorsAttributes(&$script)
  {
    $script .= <<<EOF

  protected \$ancestors = null;

EOF;
  }

  protected function addGetAncestors(&$script)
  {
    $script .= <<<EOF

  public function getAncestors(array \$options = array())
  {
    if (!isset(\$this->ancestors))
    {
      if (\$this->new)
      {
        \$this->ancestors = QubitQuery::create(array('self' => \$this) + \$options);
      }
      else
      {
        \$criteria = new Criteria;
        \$this->addAncestorsCriteria(\$criteria);
        \$this->addOrderByPreorder(\$criteria);
        \$this->ancestors = self::get(\$criteria, array('self' => \$this) + \$options);
      }
    }

    return \$this->ancestors;
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

  protected function addDescendantsAttributes(&$script)
  {
    $script .= <<<EOF

  protected \$descendants = null;

EOF;
  }

  protected function addGetDescendants(&$script)
  {
    $script .= <<<EOF

  public function getDescendants(array \$options = array())
  {
    if (!isset(\$this->descendants))
    {
      if (\$this->new)
      {
        \$this->descendants = QubitQuery::create(array('self' => \$this) + \$options);
      }
      else
      {
        \$criteria = new Criteria;
        \$this->addDescendantsCriteria(\$criteria);
        \$this->addOrderByPreorder(\$criteria);
        \$this->descendants = self::get(\$criteria, array('self' => \$this) + \$options);
      }
    }

    return \$this->descendants;
  }

EOF;
  }

  protected function addUpdateNestedSet(&$script)
  {
    $script .= <<<EOF

  protected function updateNestedSet(\$connection = null)
  {
    if (!isset(\$connection))
    {
      \$connection = QubitTransactionFilter::getConnection({$this->getPeerClassName()}::DATABASE_NAME);
    }

    if (null === \${$this->getFkVarName($this->selfFk)} = \$this->get{$this->getFkPhpName($this->selfFk)}(array('connection' => \$connection)))
    {
      \$stmt = \$connection->prepareStatement('
        SELECT MAX('.{$this->getColumnConstant($this->nestedSetRightColumn)}.')
        FROM '.{$this->getPeerClassName()}::TABLE_NAME);
      \$results = \$stmt->executeQuery(ResultSet::FETCHMODE_NUM);
      \$results->next();
      \$max = \$results->getInt(1);

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

      if (!isset(\$this->{$this->getColumnVarName($this->nestedSetLeftColumn)}) || !isset(\$this->{$this->getColumnVarName($this->nestedSetRightColumn)}))
      {
        \$delta = 2;
      }
      else
      {
        if (\$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} <= \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetLeftColumn)} && \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} >= \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)})
        {
          throw new PropelException('An object cannot be a descendant of itself.');
        }

        \$delta = \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} - \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} + 1;
      }

      \$stmt = \$connection->prepareStatement('
        UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
        SET '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' = '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' + ?
        WHERE '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' >= ?');
      \$stmt->setInt(1, \$delta);
      \$stmt->setInt(2, \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)});
      \$stmt->executeUpdate();

      \$stmt = \$connection->prepareStatement('
        UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
        SET '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' = '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' + ?
        WHERE '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' >= ?');
      \$stmt->setInt(1, \$delta);
      \$stmt->setInt(2, \${$this->getFkVarName($this->selfFk)}->{$this->getColumnVarName($this->nestedSetRightColumn)});
      \$stmt->executeUpdate();

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

    \$stmt = \$connection->prepareStatement('
      UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
      SET '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' = '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' + ?, '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' = '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' + ?
      WHERE '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' >= ?
      AND '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' <= ?');
    \$stmt->setInt(1, \$shift);
    \$stmt->setInt(2, \$shift);
    \$stmt->setInt(3, \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)});
    \$stmt->setInt(4, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)});
    \$stmt->executeUpdate();

    \$this->deleteFromNestedSet(\$connection);

    \$this->columnValues['{$this->getColumnVarName($this->nestedSetLeftColumn)}'] = \$this->{$this->getColumnVarName($this->nestedSetLeftColumn)} += \$shift;
    \$this->columnValues['{$this->getColumnVarName($this->nestedSetRightColumn)}'] = \$this->{$this->getColumnVarName($this->nestedSetRightColumn)} += \$shift;

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

    \$stmt = \$connection->prepareStatement('
      UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
      SET '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' = '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' - ?
      WHERE '.{$this->getColumnConstant($this->nestedSetLeftColumn)}.' >= ?');
    \$stmt->setInt(1, \$delta);
    \$stmt->setInt(2, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)});
    \$stmt->executeUpdate();

    \$stmt = \$connection->prepareStatement('
      UPDATE '.{$this->getPeerClassName()}::TABLE_NAME.'
      SET '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' = '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' - ?
      WHERE '.{$this->getColumnConstant($this->nestedSetRightColumn)}.' >= ?');
    \$stmt->setInt(1, \$delta);
    \$stmt->setInt(2, \$this->{$this->getColumnVarName($this->nestedSetRightColumn)});
    \$stmt->executeUpdate();

    return \$this;
  }

EOF;
  }

  protected function addClassClose(&$script)
  {
    $script .= <<<EOF
}

EOF;

    $this->addStaticMapBuilderRegistration($script);
  }

  protected function addStaticMapBuilderRegistration(&$script)
  {
    $script .= <<<EOF

{$this->basePeerClassName}::getMapBuilder('{$this->getMapBuilderBuilder()->getClassPath()}');

EOF;
  }
}
