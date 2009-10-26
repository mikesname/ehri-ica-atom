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
 * Context menu for taxonomiesg
 *
 * @package    qubit
 * @subpackage term
 * @version svn: $Id$
 * @author Peter Van Garderen <peter@artefactual.com>
 * @author David Juhasz <david@artefactual.com>
 */
class TermContextMenuComponent extends sfComponent
{
  public function execute($request)
  {
    $showContextMenu = false;
    $this->term = $request->getAttribute('term');

    // Get info object tree
    $this->termTree = null;

    if (null !== $this->term->id)
    {
      $lineage  = null;
      $criteria = new Criteria;

      $ancestors = $this->term->getAncestors()->andSelf()->orderBy('lft');
      foreach ($ancestors as $node)
      {
        $lineage[] = $node->id;
      }

      // Add root term, ancestors and their siblings
      $this->buildTermTree($ancestors->offsetGet(0), $lineage);

      if (0 < count($this->termTree))
      {
        $showContextMenu = true;
      }

      if (null !== ($this->taxonomy = $this->term->getTaxonomy()))
      {
        $showContextMenu = true;
      }
    }

    // If no context items found, don't show context menu
    if (!$showContextMenu)
    {
      return sfView::NONE;
    }
  }

  /**
   * Recursively build the "family" tree containing only the nodes in the
   * expanded branches.
   *
   * @param $node the current "parent" node
   * @param $lineage the lineage of the pivot node
   */
  protected function buildTermTree($node, $lineage)
  {
    $this->termTree[] = $node;

    $criteria = new Criteria;
    $criteria->add(QubitTerm::PARENT_ID, $node->id);
    $criteria->add(QubitTerm::TAXONOMY_ID, $this->term->taxonomyId);
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');
    $criteria->addAscendingOrderByColumn('name');

    // Exclude non-preferred terms
    $criteria->addJoin(QubitTerm::ID, QubitRelation::OBJECT_ID, Criteria::LEFT_JOIN);
    $criterion1 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID, Criteria::NOT_EQUAL);
    $criterion2 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, null, Criteria::ISNULL);
    $criterion1->addOr($criterion2);
    $criteria->add($criterion1);

    if (0 < count($children = QubitTerm::get($criteria)))
    {
      foreach ($children as $child)
      {
        // Recurse
        if (in_array($child->id, $lineage))
        {
          $this->buildTermTree($child, $lineage);
        }
        else
        {
          $this->termTree[] = $child;
        }
      }
    }
  }
}
