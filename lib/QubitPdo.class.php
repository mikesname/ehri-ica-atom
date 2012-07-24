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

/**
 * Minor adaption of Vic Cherubini's light PDO wrapper
 *
 * <http://leftnode.com/entry/the-last-php-pdo-library-you-will-ever-need>
 *
 * @package    Qubit
 * @author     Vic Cheubini
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class QubitPdo
{
  protected static $conn;

  public static function fetchAll($query, $parameters=array())
  {
    $readStmt = self::prepareAndExecute($query, $parameters);

    $fetchedRows = $readStmt->fetchAll(\PDO::FETCH_CLASS);
    $readStmt->closeCursor();

    unset($readStmt);

    return($fetchedRows);
  }

  public static function fetchOne($query, $parameters=array())
  {
    $readStmt = self::prepareAndExecute($query, $parameters);

    $fetchedRow = $readStmt->fetchObject();
    if (!is_object($fetchedRow))
    {
      $fetchedRow = false;
    }

    $readStmt->closeCursor();
    unset($readStmt);

    return($fetchedRow);
  }

  public static function fetchColumn($query, $parameters=array(), $column=0)
  {
    $column = abs((int)$column);

    $readStmt = self::prepareAndExecute($query, $parameters);
    $fetchedColumn = $readStmt->fetchColumn($column);

    $readStmt->closeCursor();
    unset($readStmt);

    return($fetchedColumn);
  }

  public static function modify($query, $parameters)
  {
    $modifyStmt = self::prepareAndExecute($query, $parameters);

    return($modifyStmt->rowCount());
  }

  private static function prepareAndExecute($query, $parameters=array())
  {
    if (!isset(self::$conn))
    {
      self::$conn = Propel::getConnection();
    }

    $prepStmt = self::$conn->prepare($query);
    $prepStmt->execute($parameters);

    return($prepStmt);
  }
}
