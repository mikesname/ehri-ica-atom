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

class QubitQuery implements ArrayAccess, Countable, Iterator
{
  protected
    $parent = null,

    $criteria = null,
    $className = null,
    $options = null,

    $statement = null,
    $objects = null,

    $offset = 0,

    $orderByName = null,
    $andSelf = null,
    $indexByName = null,

    $orderByNames = null;

  public static function create(array $options = array())
  {
    $query = new QubitQuery;
    $query->options = $options;

    return $query;
  }

  public static function createFromCriteria(Criteria $criteria, $className, array $options = array())
  {
    $query = new QubitQuery;
    $query->criteria = $criteria;
    $query->className = $className;
    $query->options = $options;

    return $query;
  }

  // Not recursive: Only ever called from the root.
  protected function getStatement(QubitQuery $leaf)
  {
    // HACK: Tell the caller whether we sorted according to the leaf
    $sorted = false;

    if (!isset($this->statement))
    {
      foreach ($leaf->getOrderByNames() as $name)
      {
        $this->criteria->addAscendingOrderByColumn(constant($this->className.'::'.strtoupper($name)));
      }
      $sorted = true;

      $this->statement = BasePeer::doSelect($this->criteria);
    }

    // TODO: Determine whether the sort order matches the previous sort order
    return array($this->statement, $sorted);
  }

  protected function getObjects(QubitQuery $leaf)
  {
    // HACK: Tell the caller whether we sorted according to the leaf
    $sorted = false;

    if (!isset($this->objects))
    {
      if (isset($this->parent))
      {
        list ($this->objects, $sorted) = $this->parent->getObjects($leaf);

        // Possibly re-index
        if (isset($this->indexByName))
        {
          $objects = array();
          foreach ($this->objects as $object)
          {
            $objects[$object[$this->indexByName]] = $object;
          }

          $this->objects = $objects;
        }
      }
      else
      {
        $this->objects = array();
        $sorted = true;

        if (isset($this->criteria))
        {
          list ($this->statement, $sorted) = $this->getStatement($leaf);

          while ($row = $this->statement->fetch())
          {
            // $this->parent is unset, so we should have a className?
            $object = call_user_func(array($this->className, 'getFromRow'), $row);

            // TODO: $this->parent is unset, so we probably do not have
            // $this->indexByName, but it would be nice to use the indexByName
            // of the leaf
            if (isset($this->indexByName))
            {
              $this->objects[call_user_func(array($object, 'get'.$this->indexByName))] = $object;
            }
            else
            {
              $this->objects[] = $object;
            }
          }
        }
      }

      // Possibly add self
      if (isset($this->andSelf))
      {
        if (count($this->objects) > 0)
        {
          $sorted = false;
        }

        if (isset($this->indexByName))
        {
          $this->objects[call_user_func(array($this->andSelf, 'get'.$this->indexByName))] = $this->andSelf;
        }
        else
        {
          $this->objects[] = $this->andSelf;
        }
      }

      // If we added to the array of objects, or we should sort and have not
      // yet sorted, then sort according to the leaf.  Since the leaf is a
      // refinement, we will be sorted at least according to our orderByName.
      // Indicate that we sorted according to the leaf, to save further
      // sorting by descendants.
      if (isset($this->orderByName) && !$sorted)
      {
        if (isset($this->indexByName))
        {
          $sorted = uasort($this->objects, array($leaf, 'sortCallback'));
        }
        else
        {
          $sorted = usort($this->objects, array($leaf, 'sortCallback'));
        }
      }
    }

    return array($this->objects, $sorted);
  }

  public function __isset($name)
  {
    list ($objects, $sorted) = $this->getObjects($this);

    return array_key_exists($name, $this->objects);
  }

  public function offsetExists($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__isset'), $args);
  }

  public function __get($name)
  {
    if ('transient' === $name)
    {
      return $this->objects;
    }

    list ($objects, $sorted) = $this->getObjects($this);

    if (isset($this->objects[$name]))
    {
      return $this->objects[$name];
    }
  }

  public function offsetGet($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__get'), $args);
  }

  public function __set($name, $value)
  {
    if (null === $name)
    {
      $this->objects[] = $value;
    }

    if (isset($this->indexByName))
    {
      $value[$this->indexByName] = $name;
      $this->objects[$name] = $value;

      // HACK
      if (isset($this->parent))
      {
        $this->parent[] = $value;
      }
    }

    return $this;
  }

  public function offsetSet($offset, $value)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__set'), $args);
  }

  public function offsetUnset($offset)
  {
  }

  protected function getCount(QubitQuery $leaf)
  {
    if (!isset($this->objects))
    {
      if (isset($this->parent))
      {
        $count = $this->parent->getCount($leaf);
      }
      else
      {
        $count = 0;

        if (isset($this->criteria))
        {
          list ($statement, $sorted) = $this->getStatement($leaf);
          $count = $statement->rowCount();
        }
      }

      if (isset($this->andSelf))
      {
        $count++;
      }

      return $count;
    }

    return count($this->objects);
  }

  public function count()
  {
    return $this->getCount($this);
  }

  public function current()
  {
    list ($objects, $sorted) = $this->getObjects($this);

    return current($this->objects);
  }

  public function key()
  {
    list ($objects, $sorted) = $this->getObjects($this);

    return key($this->objects);
  }

  public function next()
  {
    $this->offset++;

    list ($objects, $sorted) = $this->getObjects($this);

    return next($this->objects);
  }

  public function rewind()
  {
    $this->offset = 0;

    list ($objects, $sorted) = $this->getObjects($this);

    return reset($this->objects);
  }

  public function valid()
  {
    list ($objects, $sorted) = $this->getObjects($this);

    return $this->offset < count($this->objects);
  }

  protected function getOrderByNames()
  {
    if (!isset($this->orderByNames))
    {
      if (isset($this->parent))
      {
        $this->orderByNames = $this->parent->getOrderByNames();
      }
      else
      {
        $this->orderByNames = array();
      }

      if (isset($this->orderByName))
      {
        $this->orderByNames[] = $this->orderByName;
      }
    }

    return $this->orderByNames;
  }

  protected function sortCallback($a, $b)
  {
    foreach ($this->getOrderByNames() as $name)
    {
      $aGet = call_user_func(array($a, 'get'.$name));
      $bGet = call_user_func(array($b, 'get'.$name));

      if ($aGet < $bGet)
      {
        return -1;
      }

      if ($aGet > $bGet)
      {
        return 1;
      }
    }
  }

  public function orderBy($name)
  {
    $query = new QubitQuery;
    $query->parent = $this;
    $query->orderByName = $name;

    return $query;
  }

  protected function getOptions()
  {
    if (!isset($this->options))
    {
      if (isset($this->parent))
      {
        $this->options = $this->parent->getOptions();
      }
      else
      {
        $this->options = array();
      }
    }

    return $this->options;
  }

  public function andSelf()
  {
    $query = new QubitQuery;
    $query->parent = $this;

    // Set andSelf and remove 'self' option
    $query->options = $this->getOptions();
    $query->andSelf = $query->options['self'];
    unset($query->options['self']);

    return $query;
  }

  public function indexBy($name)
  {
    $query = new QubitQuery;
    $query->parent = $this;
    $query->indexByName = $name;

    return $query;
  }
}
