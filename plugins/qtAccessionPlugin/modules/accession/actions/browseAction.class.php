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

class AccessionBrowseAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->context->user->hasCredential(array('contributor', 'editor', 'administrator'), false))
    {
      QubitAcl::forwardUnauthorized();
    }

    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $criteria = new Criteria;

    switch ($request->sort)
    {
      case 'nameDown':
        $criteria->addDescendingOrderByColumn('identifier');

        break;

      case 'nameUp':
        $criteria->addAscendingOrderByColumn('identifier');

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
    $this->pager = new QubitPager('QubitAccession');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);
  }
}
