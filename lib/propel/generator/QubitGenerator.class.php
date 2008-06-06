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

class QubitGenerator extends sfPropelAdminGenerator
{
  protected function setScaffoldingClassName($className)
  {
    $this->singularName = strtolower(substr($className, 0, 1)).substr($className, 1);
    $this->pluralName = $this->singularName.'s';
    $this->className = $className;
    $this->peerClassName = $className.'Peer';
  }

  public function getColumnEditTag($column, $params = array())
  {
    if ($column->isComponent())
    {
      $moduleName = $this->getModuleName();
      $componentName = $column->getName();
      if (false !== $pos = strpos($componentName, '/'))
      {
        $moduleName = substr($componentName, 0, $pos);
        $componentName = substr($componentName, $pos + 1);
      }

      return "get_component('$moduleName', '$componentName', array('type' => 'edit', '{$this->getSingularName()}' => \${$this->getSingularName()}))";
    }

    return parent::getColumnEditTag($column, $params);
  }
}
