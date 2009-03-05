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
 * Digital Object - display compound digital asset
 *
 * @package    qubit
 * @subpackage digital object
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class DigitalObjectShowCompoundComponent extends sfComponent
{
  /**
   * Show a page turner for compound digital objects
   *
   * @param sfWebRequest $request
   */
  public function execute($request)
  {
    // Make sure that this 'display_as_compound_object' is set to yes
    $displayAsCompoundProp = QubitProperty::getOneByObjectIdAndName($this->informationObject->getId(), 'display_as_compound_object');
    $this->isCompoundDigitalObject = (is_null($displayAsCompoundProp)) ? false : true;
    $this->masterDigitalObject = $this->informationObject->getDigitalObject();

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject'))
    {
      $this->editCredentials = true;
    }

    // Find all digital objects of child info objects
    $criteria = new Criteria;
    $criteria->addJoin(QubitInformationObject::ID, QubitDigitalObject::INFORMATION_OBJECT_ID, Criteria::INNER_JOIN);
    $criteria->add(QubitInformationObject::PARENT_ID, $this->informationObject->getId(), Criteria::EQUAL);

    // Show two results on page with pager
    $this->page = $request->getParameter('page', 1);
    $pager = new QubitPager('QubitDigitalObject', 2);
    $pager->setCriteria($criteria);
    $pager->setPage($this->page);
    $pager->init();
    $results = $pager->getResults();

    $this->leftObject = $results->offsetGet(0);
    $this->rightObject = (count($results) > 1) ? $results->offsetGet(1) : null;

    // Link pages to fullscreen view
    $this->leftObjectLink = $this->rightObjectLink = null;
    if ($this->editCredentials || $this->masterDigitalObject->getMediaTypeId() == QubitTerm::TEXT_ID)
    {
      $this->leftObjectLink = 'digitalobject/showFullScreen?id='.$this->leftObject->getId();

      if (null !== $this->rightObject)
      {
        $this->rightObjectLink = 'digitalobject/showFullScreen?id='.$this->rightObject->getId();
      }
    }

    // Show link to download master digital object
    $this->masterDigiObjectLink = null;
    if ($this->editCredentials && null !== $this->masterDigitalObject)
    {
      $this->masterDigiObjectLink = $request->getUriPrefix().$request->getRelativeUrlRoot().$this->masterDigitalObject->getFullPath();
    }

    // Link for prev/next page
    $this->currentObjectRoute = 'informationobject/show?id='.$this->informationObject->getId();

    $this->pager = $pager;
  }
}