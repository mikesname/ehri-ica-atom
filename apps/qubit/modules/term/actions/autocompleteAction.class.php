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

class TermAutocompleteAction extends sfAction
{
  public function execute($request)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag','Url'));

    $this->taxonomy = QubitTaxonomy::getById($request->taxonomyId);
    if (null === $this->taxonomy)
    {

      return $this->renderText(null);
    }

    $criteria = new Criteria;
    $criteria->add(QubitTermI18n::NAME, $request->query.'%', Criteria::LIKE);
    $criteria->add(QubitTerm::TAXONOMY_ID, $request->taxonomyId, Criteria::EQUAL);
    $criteria->addAscendingOrderByColumn('name');
    $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
    $criteria->setDistinct();
    $criteria->setLimit(10);

    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');

    $tableHtml = <<<EOL
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <title>Taxonomy List</title>
</head>
<body>
<table>
<thead>
<tr><th>term</th></tr>
</thead>
<tbody>

EOL;

    foreach (QubitTerm::get($criteria) as $term)
    {
      // Search for preferred term
      $c = new Criteria;
      $c->add(QubitRelation::OBJECT_ID, $term->id);
      $c->add(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID);
      $c->addJoin(QubitRelation::SUBJECT_ID, QubitTerm::ID, Criteria::INNER_JOIN);

      if (null !== ($prefTerm = QubitTerm::getOne($c)))
      {
        $termId = $prefTerm->id;
        $label = $this->getContext()->getI18N()->__('%1% (use: %2%)', array('%1%' => $term->getName(array('cultureFallback' => true)), '%2%' => $prefTerm->getName(array('cultureFallback' => true))));
      }
      else
      {
        $termId = $term->id;
        $label = $term->getName(array('cultureFallback' => true));
      }

      $tableHtml .= '<tr><td>'.link_to($label, array('module' => 'term', 'action' => 'show', 'id' => $termId)).'</td></tr>';
      $tableHtml .= "\n";
    }

    $tableHtml .= <<<EOL
</tbody>
</table>
</body>
</html>
EOL;

    return $this->renderText($tableHtml);
  }
}
