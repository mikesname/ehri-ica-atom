<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class QubitObjectBuilder extends SfObjectBuilder
{
  protected
    $nestedSetLeftColumn = null,
    $nestedSetRightColumn = null;

  public function __construct(Table $table)
  {
    parent::__construct($table);
    $this->initialize($table);
  }

  public function initialize(Table $table)
  {
    foreach ($table->getColumns() as $column)
    {
      if ($column->getAttribute('nestedSetLeftKey'))
      {
        $this->nestedSetLeftColumn = $column;
      }

      if ($column->getAttribute('nestedSetRightKey'))
      {
        $this->nestedSetRightColumn = $column;
      }
    }
  }

  protected function addClassBody(&$script)
  {
    parent::addClassBody($script);

    if ($this->getTable()->getAttribute('treeMode') == 'NestedSet')
    {
      $this->addAddIsAncestor($script);
    }
  }

  protected function addAddIsAncestor(&$script)
  {
    $nestedSetLeftColumnName = PeerBuilder::getColumnName($this->nestedSetLeftColumn, $this->getTable()->getPhpName());
    $nestedSetRightColumnName = PeerBuilder::getColumnName($this->nestedSetRightColumn, $this->getTable()->getPhpName());

    $script .= <<<EOF

  public function addIsAncestor(Criteria \$c)
  {
    \$c->add({$nestedSetLeftColumnName}, \$this->{$this->nestedSetLeftColumn->getName()}, Criteria::LESS_THAN);
    \$c->add({$nestedSetRightColumnName}, \$this->{$this->nestedSetRightColumn->getName()}, Criteria::GREATER_THAN);
  }
EOF;
  }
}
