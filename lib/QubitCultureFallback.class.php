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
 * @package    qubit
 * @subpackage lib
 * @author     David Juhasz <david@artefactual.com>
 * @version    $Id$
 */
class QubitCultureFallback
{

  /**
   * Assign fallback values for each column in the $fallbackClassName table
   *
   * @param  Criteria $criteria
   * @param  string   $fallbackClass name of Prople class for table with desired fallback columns
   * @return Criteria $criteria object withi extra calculated fallback columns
   */
  public static function addFallbackColumns($criteria, $fallbackClassName)
  {
    // Get array of column names by getting a table map via MapBuilder class
    // for passed fallback table
    $mapBuilderClassName = substr($fallbackClassName, 5).'MapBuilder';
    $objectMapBuilder = eval ('return new '.$mapBuilderClassName.';');
    $tableName = eval('return '.$fallbackClassName.'::TABLE_NAME;');

    // Build the database and table map, and then get tableMap
    call_user_func(array($objectMapBuilder, 'doBuild'));
    $tableMap = $objectMapBuilder->getDatabaseMap()->getTable($tableName);

    // Loop through table columns and add fallback calculated fields to criteria
    foreach ($tableMap->getColumns() as $col)
    {
      $criteria->addAsColumn($col->getColumnName(), self::getfallbackCaseStmt($col->getColumnName()));
    }

    return $criteria;
  }


  /**
   * Build SQL 'case' statement to get the most relevant value for $column
   *
   * @param string $column name
   * @return string SQL case statement
   */
  protected static function getfallbackCaseStmt($column)
  {
    $fallbackCaseStmt  = '(CASE WHEN (current.'.$column.' IS NOT NULL AND current.'.$column.' <> \'\') THEN current.'.$column;
    $fallbackCaseStmt .= ' ELSE source.'.$column.' END)';

    return $fallbackCaseStmt;
  }


  /**
   * Add fallback query criteria to $criteria
   *
   * @param Criteria $criteria
   * @param array $options
   * @return QubitQuery array of objects
   */
  public static function addFallbackCriteria($criteria, $fallbackClassName, $options = array())
  {
    if (isset($options['culture']))
    {
      $culture = $options['culture'];
    }
    else
    {
      $culture = sfContext::getInstance()->getUser()->getCulture();
    }

    // Expose class constants so we can call them using a dynamic class name
    $fallbackClass = new ReflectionClass($fallbackClassName);
    $fallbackClassI18n = new ReflectionClass($fallbackClassName.'I18n');

    // Add fallback columns (calculated)
    $criteria = self::addFallbackColumns($criteria, $fallbackClassI18n->getName());

    // Get i18n "CULTURE" column name, with "<tablename>." stripped off the front
    $cultureColName = str_replace($fallbackClassI18n->getConstant('TABLE_NAME').'.', '', $fallbackClassI18n->getConstant('CULTURE'));

    // Build join strings
    $currentJoinString = 'current.id AND current.'.$cultureColName.' = \''.$culture.'\'';

    $sourceJoinString = 'source.id AND source.'.$cultureColName.' = '.$fallbackClass->getConstant('SOURCE_CULTURE');
    $sourceJoinString .= ' AND source.'.$cultureColName.' <> \''.$culture.'\'';

    // Build fancy criteria to get fallback values
    $criteria->addAlias('current', $fallbackClassI18n->getConstant('TABLE_NAME'));
    $criteria->addAlias('source', $fallbackClassI18n->getConstant('TABLE_NAME'));

    $criteria->addJoin(array($fallbackClass->getConstant('ID'), 'current.'.$cultureColName), array('current.id', '\''.$culture.'\''), Criteria::LEFT_JOIN);
    $criteria->addJoin(
      array($fallbackClass->getConstant('ID'), 'source.'.$cultureColName),
      array('source.id', $fallbackClass->getConstant('SOURCE_CULTURE').' AND source.'.$cultureColName.' <> \''.$culture.'\''),
      Criteria::LEFT_JOIN);

    return $criteria;
  }

}
