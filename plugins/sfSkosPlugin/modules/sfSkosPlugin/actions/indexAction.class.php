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

/**
 * SKOS representation of taxonomic data.
 *
 * @package    qubit
 * @subpackage sfSkosPlugin
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */

class sfSkosPluginIndexAction extends sfAction
{
  public function execute($request)
  {
    $resource = $this->getRoute()->resource;

    if (!isset($resource))
    {
      $this->forward404();
    }

    if ('QubitTerm' == $resource->className)
    {
      $term = QubitTerm::getById($resource->id);
      $this->terms = $term->descendants->andSelf()->orderBy('lft');
      $this->taxonomy = $term->taxonomy;
      $this->topLevelTerms = array($term);
    }
    else
    {
      $this->terms = QubitTaxonomy::getTaxonomyTerms($resource->id);
      $this->taxonomy = QubitTaxonomy::getById($resource->id);
      $this->topLevelTerms = QubitTaxonomy::getTaxonomyTerms($resource->id, array('level' => 'top'));
    }
  }
}
