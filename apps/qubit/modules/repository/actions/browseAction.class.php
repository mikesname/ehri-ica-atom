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
 * @package    qubit
 * @subpackage repository
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Wu Liu <wu.liu@usask.ca>
 * @version    svn:$Id$
 */
class RepositoryBrowseAction extends sfAction
{
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $criteria = new Criteria;

    // Do source culture fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitActor');

    if (isset($request->countryCode))
    {
      $criteria->addJoin(QubitRepository::ID, QubitContactInformation::ACTOR_ID, Criteria::LEFT_JOIN);
      $ct1 = $criteria->getNewCriterion(QubitContactInformation::COUNTRY_CODE, $request->countryCode);
      $criteria->addAnd($ct1);
    }

    // don't let ananymous users see records with draft status
    if (!$this->getUser()->isAuthenticated())
    {
      $criteria->addJoin(QubitRepository::ID, QubitStatus::OBJECT_ID, Criteria::LEFT_JOIN);
      $ct1 = $criteria->getNewCriterion(QubitStatus::TYPE_ID, QubitTerm::STATUS_TYPE_PUBLICATION_ID);
      $ct2 = $criteria->getNewCriterion(QubitStatus::STATUS_ID, QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID);
      $ct1->addAnd($ct2);
      $criteria->addAnd($ct1);
    }

    $conn = Propel::getConnection();
    $stmt = $conn->prepare("SELECT DISTINCT country_code from ".QubitContactInformation::TABLE_NAME." where country_code is not null order by country_code;");
    $stmt->execute();
    $res = $stmt->fetchAll();
    $countries = array_map(function($a) { return $a["country_code"];}, $res);
    $stmt->closeCursor();
    $conn->clearStatementCache();

    $this->form = new sfForm();
    $this->form->setValidator('countryCode', new sfValidatorI18nChoiceCountry);
    $this->form->setWidget('countryCode', new sfWidgetFormI18nChoiceCountry(array('countries' => $countries, 'add_empty' => true, 'culture' => $this->context->user->getCulture())));
    $this->form->setDefault('countryCode', $request->countryCode);
    $this->form->setValidator('limit', new sfValidatorInteger);
    $this->form->setWidget('limit', new sfWidgetFormInputHidden);
    $this->form->setDefault('limit', $request->limit);
    $this->form->setValidator('page', new sfValidatorInteger);
    $this->form->setWidget('page', new sfWidgetFormInputHidden);
    $this->form->setDefault('page', $request->page);

    switch ($request->sort)
    {
      case 'nameDown':
        $criteria->addDescendingOrderByColumn('authorized_form_of_name');

        break;

      case 'nameUp':
        $criteria->addAscendingOrderByColumn('authorized_form_of_name');

        break;

      case 'updatedDown':
        $criteria->addDescendingOrderByColumn(QubitObject::UPDATED_AT);

        break;

      case 'updatedUp':
        $criteria->addAscendingOrderByColumn(QubitObject::UPDATED_AT);

        break;

      default:
        if (!$this->getUser()->isAuthenticated())
        {
          $criteria->addAscendingOrderByColumn('authorized_form_of_name');
        }
        else
        {
          $criteria->addDescendingOrderByColumn(QubitObject::UPDATED_AT);
        }
    }

    // Page results
    $this->pager = new QubitPager('QubitRepository');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);
  }
}
