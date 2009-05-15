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
 * Factory for running Qubit data migrations
 *
 * @package    qubit
 * @subpackage migration
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class QubitMigrator
{
  protected $data = null;
  protected $dataModified = false;

  public function __construct($data)
  {
    $this->setData($data);
  }

  public function setData($data)
  {
    $this->data = $data;

    return $this;
  }

  public function getData()
  {
    return $this->data;
  }

  public function isDataModified()
  {
    return $this->dataModified;
  }

  public function migrate103to104()
  {
    $migrator = new QubitMigrate103to104($this->data);
    $this->data = $migrator->execute();
    $this->dataModified = true;

    return $this;
  }

  public function migrate104to105()
  {
    $migrator = new QubitMigrate104to105($this->data);
    $this->data = $migrator->execute();
    $this->dataModified = true;

    return $this;
  }

  public function migrate105to106()
  {
    $migrator = new QubitMigrate105to106($this->data);
    $this->data = $migrator->execute();
    $this->dataModified = true;

    return $this;
  }

  public function migrate106to107()
  {
    $migrator = new QubitMigrate106to107($this->data);
    $this->data = $migrator->execute();
    $this->dataModified = true;

    return $this;
  }
}