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
 * This class is used to provide methods that supplement the core Qubit
 * information object with behaviour or presentation features that are specific
 * to the ICA's International Standard Archival Description (ISAD)
 *
 * @package    Qubit
 * @author     Mike Bryant <michael.bryant@kcl.ac.uk>
 * @version    svn:$Id$
 */

class sfEhriIsadPlugin extends sfIsadPlugin
{
  private
    $_meta;

  public function __get($name)
  {
    switch ($name)
    {
      case '_ehriMeta':

        if (!isset($this->_meta))
        {            
          $criteria = new Criteria;
          $this->resource->addPropertysCriteria($criteria);
          $criteria->add(QubitProperty::NAME, "ehrimeta");

          if (1 == count($query = QubitProperty::get($criteria)))
          {
            $this->_meta = $query[0];
          }
          else
          {
            $this->_meta = new QubitProperty;
            $this->_meta->name = "ehrimeta";
            $this->_meta->value = serialize(array());
            $this->resource->propertys[] = $this->_meta;
          }
        }
        return $this->_meta;

      case 'ehriCopyrightIssue':
      case 'ehriPriority':
        $meta = unserialize($this->_ehriMeta->value);
        return array_key_exists($name, $meta) ? $meta[$name] : NULL;
      default:
        return parent::__get($name);
    }
  }

  public function __set($name, $value)
  {
    switch ($name)
    {
    case 'ehriCopyrightIssue':
    case 'ehriPriority':
        $meta = unserialize($this->_ehriMeta->value);
        $meta[$name] = $value;
        $this->_ehriMeta->value = serialize($meta);
        return $this;
    default:
      return parent::__set($name, $value);
    }
  }
}
