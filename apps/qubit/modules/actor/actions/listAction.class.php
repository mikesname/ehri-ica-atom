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
 * Show paginated list of actors.
 *
 * @package    qubit
 * @subpackage actor
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class ActorListAction extends sfAction
{
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $search = new QubitSearch;

    $query = new Zend_Search_Lucene_Search_Query_Boolean;
    $query->addSubquery(new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term('QubitActor', 'className')), true /* required */);

    if (isset($request->subquery))
    {
      try
      {
        // Parse query string
        $query->addSubquery(Zend_Search_Lucene_Search_QueryParser::parse($request->subquery), true /* required */);
      }
      catch (Exception $e)
      {
        $this->error = $e->getMessage();

        return;
      }
    }

    $query = QubitAcl::searchFilterByResource($query, QubitActor::getById(QubitActor::ROOT_ID));

    $this->pager = new QubitArrayPager;

    try
    {
      $this->pager->hits = $search->getEngine()->getIndex()->find($query);
    }
    catch (Exception $e)
    {
      $this->error = $e->getMessage();

      return;
    }

    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);

    $ids = array();
    foreach ($this->pager->getResults() as $hit)
    {
      $ids[] = $hit->getDocument()->id;
    }

    $criteria = new Criteria;
    $criteria->add(QubitActor::ID, $ids, Criteria::IN);

    $this->actors = QubitActor::get($criteria);
  }
}
