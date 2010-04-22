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

class DefaultMoveAction extends sfAction
{
  public function execute($request)
  {
    // Default items per page
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $this->form = new sfForm;

    $this->object = QubitObject::getById($request->id);

    // Check that object exists and that it is not the root
    if (!isset($this->object) || !isset($this->object->parent))
    {
      $this->forward404();
    }

    // Check authorization
    if (!QubitAcl::check($this->object, 'update'))
    {
      QubitAcl::forwardUnauthorized();
    }

    // "parent" form field
    $this->form->setValidator('parent', new sfValidatorString(array('required' => true)));
    $this->form->setWidget('parent', new sfWidgetFormInputHidden);

    // Root is default parent
    $this->form->bind($request->getGetParameters() + array('parent' => $this->context->routing->generate(null, array(QubitInformationObject::getById(QubitInformationObject::ROOT_ID), 'module' => 'informationobject'))));

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->parent->getValue()));
        $this->object->parentId = $params['id'];

        $this->object->save();

        if ($request->isXmlHttpRequest())
        {
          return $this->renderText('');
        }
        else
        {
          if ($this->object instanceof QubitInformationObject)
          {
            $this->redirect(array($this->object, 'module' => 'informationobject'));
          }
          else if ($this->object instanceof QubitTerm)
          {
            $this->redirect(array($this->object, 'module' => 'term'));
          }
        }
      }
    }

    $params = $this->context->routing->parse(Qubit::pathInfo($this->form->parent->getValue()));
    $this->parent = QubitObject::getById($params['id']);

    $search = new QubitSearch;
    $query = new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($this->parent->id, 'parentId'));

    if (isset($request->query))
    {
      $query = $request->query;
    }

    $this->pager = new QubitArrayPager;
    $this->pager->hits = $search->getEngine()->getIndex()->find($query);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);

    $ids = array();
    foreach ($this->pager->getResults() as $hit)
    {
      $ids[] = $hit->getDocument()->id;
    }

    $criteria = new Criteria;
    $criteria->add(QubitObject::ID, $ids, Criteria::IN);

    $this->results = QubitObject::get($criteria);
  }
}
