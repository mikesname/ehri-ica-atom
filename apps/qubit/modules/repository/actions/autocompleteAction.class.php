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

class RepositoryAutocompleteAction extends sfAction
{
  public function execute($request)
  {
    $criteria = new Criteria;
    $criteria->add(QubitObject::CLASS_NAME, 'QubitRepository');
    $criteria->addJoin(QubitActorI18n::ID, QubitActor::ID);
    $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $request->query.'%', Criteria::LIKE);
    $criteria->addAscendingOrderByColumn('authorized_form_of_name');
    $criteria->setDistinct();
    $criteria->setLimit(sfConfig::get('app_hits_per_page', 10));

    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitActor');

    // Filter 'denied' repositories if list for repository auto-complete on info
    // object form
    if (isset($request->aclAction))
    {
      $repositoryList = array();
      $repositoryAccess = QubitAcl::getRepositoryAccess($request->aclAction);

      // If all repositories are denied, no response
      if (1 == count($repositoryAccess) && QubitAcl::DENY == $repositoryAccess[0]['access'])
      {

        return sfView::NONE;
      }
      else
      {
        while ($repo = array_shift($repositoryAccess))
        {
          if ('*' != $repo['id'])
          {
            $repositoryList[] = $repo['id'];
          }
          else
          {
            if (QubitAcl::DENY == $repo['access'])
            {
              // Require repos to be specifically allowed (all others prohibited)
              $criteria->add(QubitRepository::ID, $repositoryList + array('null'), Criteria::IN);
            }
            else
            {
              // Prohibit specified repos (all others allowed)
              $criteria->add(QubitRepository::ID, $repositoryList, Criteria::NOT_IN);
            }
          }
        }
      }

    }

    $this->repositories = QubitRepository::get($criteria);
  }
}
