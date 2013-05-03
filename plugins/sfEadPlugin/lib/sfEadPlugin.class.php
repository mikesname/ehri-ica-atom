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
 * @subpackage sfEadPlugin
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn: $Id$
 */
class sfEadPlugin
{
  public
    $resource;

  public function __construct($resource)
  {
    $this->resource = $resource;
  }

  public function agencyCode()
  {
    if (null !== $this->resource->getRepository(array('inherit' => true)))
    {
      $country = $this->resource->getRepository(array('inherit' => true))->getCountryCode();
      $agency = $this->resource->getRepository(array('inherit' => true))->id;

      if (isset($country) && isset($agency))
      {
        return sprintf("%s-%06d", strToLower($country), $agency);
      }
    }
    return '';
  }

  public function renderEadId()
  {
    $countryCode = $mainAgencyCode = '';

    if (null !== $this->resource->getRepository(array('inherit' => true)))
    {
      if (null !== $country = strToLower($this->resource->getRepository(array('inherit' => true))->getCountryCode()))
      {
        $countryCode = " countrycode=\"$country\"";
      }

      //if (null !== $agency = $this->resource->getRepository(array('inherit' => true))->getIdentifier())
      if (null !== $agency = sprintf("%06d", $this->resource->getRepository(array('inherit' => true))->id))
      {
        if (isset($country))
        {
          $agency = $country.'-'.$agency;
        }

        $mainAgencyCode = " mainagencycode=\"$agency\"";
      }
    }

    $url = url_for(array($this->resource, 'module' => 'informationobject', 'sf_format' => 'xml'), $absolute = true);

    return "<eadid$countryCode$mainAgencyCode url=\"$url\" encodinganalog=\"Identifier\">{$this->resource->identifier}</eadid>";
  }
}
