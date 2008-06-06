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

class QubitTransactionFilter extends sfFilter
{
  protected static $connection = null;

  public static function getConnection()
  {
    if (!isset(self::$connection))
    {
      self::$connection = Propel::getConnection();
      self::$connection->begin();
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
          self::$connection->rollback();
        }
      }

      throw $e;
    }
  }
}
