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
    $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($request->getPathInfoPrefix(), '/').'/', null, $request->getHttpHeader('Referer')));
    if ($request->isXmlHttpRequest() && 'actor' == $params['module'])
    {
      return $this->ajaxResponse($request);
    }
    else
    {
      $this->htmlResponse($request);
    }
  }

  protected function ajaxResponse($request)
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID, Criteria::INNER_JOIN);
    $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $request->query.'%', Criteria::LIKE);
    $criteria->add(QubitActorI18n::CULTURE, $this->getUser()->getCulture(), Criteria::EQUAL);

    // Exclude the calling actor from the list
    if (0 < strlen ($notId = $request->getParameter('not')))
    {
      $criteria->add(QubitActor::ID, $notId, Criteria::NOT_EQUAL);
    }
    $criteria->addAscendingOrderByColumn(QubitActorI18n::AUTHORIZED_FORM_OF_NAME);
    $criteria->setLimit(10);

    $actors = QubitActor::get($criteria);
    foreach ($actors as $actor)
    {
      $results[] = array('id' => $actor->id, 'name' => $actor->authorizedFormOfName);
    }

    return $this->renderText(json_encode(array('Results' => $results)));
  }

  protected function htmlResponse($request)
  {
    $search = new QubitSearch;
    $query = new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term('QubitActor', 'className'));

    if (isset($request->query))
    {
      $query = new Zend_Search_Lucene_Search_Query_Boolean(array($query, Zend_Search_Lucene_Search_QueryParser::parse($request->query)));
    }

    $this->pager = new QubitSearchPager;
    $this->pager->hits = $search->getEngine()->getIndex()->find($query);
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
