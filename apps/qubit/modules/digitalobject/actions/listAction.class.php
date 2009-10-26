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
 * @package    qubit
 * @subpackage digitalobject
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn: $Id$
 */
class DigitalObjectListAction extends sfAction
{
  /**
   * Execute digitalobject list action
   *
   * @param sfWebRequest $request
   */
  public function execute($request)
  {
    // Build funky join query to get a count of top level digital objects
    // for each media type (term)
    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MEDIA_TYPE_ID);
    $criteria->addJoin(QubitTerm::ID, QubitDigitalObject::MEDIA_TYPE_ID, Criteria::LEFT_JOIN);
    $criteria->addAsColumn('hits', 'COUNT('.QubitDigitalObject::ID.')');
    $criteria->addGroupByColumn(QubitTerm::ID);
    $criteria->addAscendingOrderByColumn('name');

    // Add I18n fallback
    $options = array();
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $options);

    $this->terms = QubitTerm::get($criteria);

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'actor'))
    {
      $this->editCredentials = true;
    }

    //set view template
    switch ($this->getRequestParameter('template'))
    {
      case 'anotherTemplate' :
        $this->setTemplate('anotherTemplate');
        break;
      default :
        //$this->setTemplate(sfConfig::get('app_default_template_mediatype_list'));
        $this->setTemplate('list');
    }
  }
}
