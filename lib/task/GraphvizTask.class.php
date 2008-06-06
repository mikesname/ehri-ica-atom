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

class GraphvizTask extends sfPropelBaseTask
{
  /**
   * @see BaseTask::configure()
   */
  protected function configure()
  {
    $this->namespace = 'propel';
    $this->name = 'graphviz';
    $this->briefDescription = 'Creates Graphviz for current model';
    $this->detailedDescription = <<<EOF
The [propel:graphviz|INFO] task creates DOT visualization for automatic graph drawing:

  [./symfony propel:graphviz|INFO]
EOF;
  }

  /**
   * @see BaseTask::execute()
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->schemaToXML(self::DO_NOT_CHECK_SCHEMA, 'generated-');
    $this->copyXmlSchemaFromPlugins('generated-');
    $this->callPhing('graphviz', self::CHECK_SCHEMA);
    $this->cleanup();
  }
}
