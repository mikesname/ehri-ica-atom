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

    $this->resource = $this->getRoute()->resource;

    // Check that the object exists and that it is not the root
    if (!isset($this->resource) || !isset($this->resource->parent))
    {
      $this->forward404();
    }

    // Check authorization
    if (!QubitAcl::check($this->resource, 'update'))
    {
      QubitAcl::forwardUnauthorized();
    }

    // "parent" form field
    $this->form->setValidator('parent', new sfValidatorString(array('required' => true)));
    $this->form->setWidget('parent', new sfWidgetFormInputHidden);

    // Root is default parent
    if ($this->resource instanceof QubitInformationObject)
    {
      $this->form->bind($request->getGetParameters() + array('parent' => $this->context->routing->generate(null, array(QubitInformationObject::getById(QubitInformationObject::ROOT_ID), 'module' => 'informationobject'))));
    }
    else if ($this->resource instanceof QubitTerm)
    {
      $this->form->bind($request->getGetParameters() + array('parent' => $this->context->routing->generate(null, array(QubitTerm::getById(QubitTerm::ROOT_ID), 'module' => 'term'))));
    }

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->parent->getValue()));

        // In term treeview, root node links (href) to taxonomy, but it represents the term root object
        if ($this->resource instanceOf QubitTerm && QubitObject::getById($params['_sf_route']->resource->id) instanceof QubitTaxonomy)
        {
          $this->resource->parentId = QubitTerm::ROOT_ID;
        }
        else
        {
          $this->resource->parentId = $params['_sf_route']->resource->id;
        }

        $this->resource->save();

        if ($request->isXmlHttpRequest())
        {
          return $this->renderText('');
        }
        else
        {
          if ($this->resource instanceof QubitInformationObject)
          {
            $this->redirect(array($this->resource, 'module' => 'informationobject'));
          }
          else if ($this->resource instanceof QubitTerm)
          {
            $this->redirect(array($this->resource, 'module' => 'term'));
          }
        }
      }
    }

    $params = $this->context->routing->parse(Qubit::pathInfo($this->form->parent->getValue()));
    $this->parent = QubitObject::getById($params['_sf_route']->resource->id);

    $query = QubitSearch::getInstance()->addTerm($this->parent->slug, 'parent');

    if (isset($request->query))
    {
      $query = $request->query;
    }

    $this->pager = new QubitArrayPager;
    $this->pager->hits = QubitSearch::getInstance()->getEngine()->getIndex()->find($query);
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
