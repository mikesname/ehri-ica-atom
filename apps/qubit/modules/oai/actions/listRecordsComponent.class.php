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
 * Generate  listRecordsAction response of the OAI-PMH protocol for the qubit toolkit
 *
 * @package    qubit
 * @subpackage oai
 * @version    svn: $Id$
 * @author     Mathieu Fortin Library and Archives Canada <mathieu.fortin@lac-bac.gc.ca>
 */
class OaiListRecordsComponent extends sfComponent
{

  public function execute($request)
  {
    $this->requestname = $request;
    $request->setRequestFormat('xml');
    $this->date = gmdate('Y-m-d\TH:i:s\Z');
    $this->attributes = $request->getGetParameters();

    /*
     * If limit dates are not supplied, define them as ''
     */
    if (!$request->hasParameter('from'))
    {
      $this->from = '';
    }
    else
    {
      $this->from = $request->getParameter('from');
    }

    if (!$request->hasParameter('until'))
    {
      $this->until = '';
    }
    else
    {
      $this->until = $request->getParameter('until');
    }

    $this->collectionsTable = QubitOai::getCollectionArray();

    /*
     * If set is not supplied, define it as ''
     */
    if (!$request->hasParameter('set'))
    {
      $collection = '';
    }
    else
    {
      $collection = QubitOai::getCollectionInfo($request->getParameter('set'), $this->collectionsTable);
    }

    //Get the records according to the limit dates and collection
    $this->records = QubitInformationObject::getUpdatedRecords($this->from, $this->until, $collection);
    $this->publishedRecords = array();
    foreach ($this->records as $record)
    {
      if ($record->getPublicationStatus()->statusId == QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID)
      {
        $this->publishedRecords[] = $record;
      }
    }
    $this->recordsCount = count($this->publishedRecords);
    $this->path = $request->getUriPrefix().$request->getPathInfo();

    $this->attributesKeys = array_keys($this->attributes);
    $this->requestAttributes = '';
    foreach ($this->attributesKeys as $key)
    {
      $this->requestAttributes .= ' '.$key.'="'.$this->attributes[$key].'"';
    }
  }
}
