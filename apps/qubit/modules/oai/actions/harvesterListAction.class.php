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
 * Generate the OAI-PMH response
 *
 * @package    qubit
 * @subpackage oai
 * @version    svn: $Id$
 * @author     Mathieu Fortin Library and Archives Canada <mathieu.fortin@lac-bac.gc.ca>
 */
class oaiHarvesterListAction extends sfAction
{

   /*
   * Executes action
   *
   * @param sfRequest $request A request object
   */
  public function execute($request)
  {
    $this->form = new OaiAddRepositoryForm();
    $this->repositories = QubitOaiRepository::getRepositories();
    $this->harvestJob = array();
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('oai_harvester'));
      if ($this->form->isValid())
      {
        $harvesterArr = $request->getParameter('oai_harvester');

        if (count(QubitOaiRepository::getByURI($harvesterArr['uri'])) != 0)
        {
           $this->request->setAttribute('preExistingRepository', true);
           $this->forward('oai', 'harvesterNewRepository');
        }
        $URI = $harvesterArr['uri'];
        $URI .= '?verb=Identify';
        $oaiSimple = simplexml_load_file($URI);
        libxml_use_internal_errors(true);
        if ($oaiSimple)
        {
          $repository = new QubitOaiRepository();
          $Identify = $oaiSimple->Identify;

          $repository->setName($Identify->repositoryName);
          $repository->setUri($harvesterArr['uri']);
          $repository->setAdminEmail($Identify->adminEmail);
          $repository->setEarliestTimestamp($Identify->earliestDatestamp);
          $repository->save();

          $harvest = new QubitOaiHarvest();
          $harvest->setOaiRepository($repository);
          $harvest->setMetadataPrefix('oai_dc');
          $harvest->save();
          $this->redirect('oai/harvesterNewRepository');
        } else
        {
          $this->request->setAttribute('parsingErrors', true);
          $this->forward('oai', 'harvesterNewRepository');
        }
      }
    }
  }
}
