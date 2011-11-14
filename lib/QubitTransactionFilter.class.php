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

class QubitTransactionFilter extends sfFilter
{
  protected static
    $connection = null;

  public static function getConnection()
  {
    if (!isset(self::$connection))
    {
      self::$connection = Propel::getConnection();
      // self::$connection->beginTransaction();
    }

    return self::$connection;
  }

  public function execute($filterChain)
  {
    try
    {
      $filterChain->execute();

      if (isset(self::$connection))
      {
        self::$connection->commit();
      }
    }
    catch (Exception $e)
    {
      if (isset(self::$connection))
      {
        // Whitelist of exceptions which commit instead of rollback the
        // transaction
        if ($e instanceof sfStopException)
        {
          self::$connection->commit();
        }
        else
        {
          self::$connection->rollBack();
        }
      }

      throw $e;
    }
  }
}
