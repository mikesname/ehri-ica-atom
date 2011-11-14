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
 * This class is used to provide methods that supplement the core Qubit
 * information object with behaviour or presentation features that are specific
 * to the ICA's International Standard Archival Description (ISAD)
 *
 * @package    Qubit
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */

class sfIsadPlugin implements ArrayAccess
{
  protected
    $resource;

  public function __construct(QubitInformationObject $resource)
  {
    $this->resource = $resource;
  }

  public function __toString()
  {
    $string = array();

    $levelOfDescriptionAndIdentifier = array();

    if (isset($this->resource->levelOfDescription))
    {
      $levelOfDescriptionAndIdentifier[] = $this->resource->levelOfDescription->__toString();
    }

    if (isset($this->resource->identifier))
    {
      $levelOfDescriptionAndIdentifier[] = $this->resource->identifier;
    }

    if (0 < count($levelOfDescriptionAndIdentifier))
    {
      $string[] = implode($levelOfDescriptionAndIdentifier, ' ');
    }

    $titleAndPublicationStatus = array();

    if (0 < strlen($this->resource->__toString()))
    {
      $titleAndPublicationStatus[] = $this->resource->__toString();
    }

    $publicationStatus = $this->resource->getPublicationStatus();
    if (isset($publicationStatus) && QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $publicationStatus->statusId)
    {
      $titleAndPublicationStatus[] = "({$publicationStatus->status->__toString()})";
    }

    if (0 < count($titleAndPublicationStatus))
    {
      $string[] = implode($titleAndPublicationStatus, ' ');
    }

    return implode(' - ', $string);
  }

  public function offsetExists($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__isset'), $args);
  }

  public function __get($name)
  {
    switch ($name)
    {
      case 'referenceCode':

        if (sfConfig::get('app_inherit_code_informationobject'))
        {
          if (!isset($this->resource->identifier))
          {
            return;
          }

          $identifier = array();
          $repository = null;
          foreach ($this->resource->ancestors->andSelf()->orderBy('lft') as $item)
          {
            if (isset($item->identifier))
            {
              $identifier[] = $item->identifier;
            }

            if (isset($item->repository))
            {
              $repository = $item->repository;
            }
          }
          $identifier = implode(sfConfig::get('app_separator_character', '-'), $identifier);

          if (isset($repository->identifier))
          {
            $identifier = "$repository->identifier $identifier";
          }

          if (isset($repository))
          {
            $countryCode = $repository->getCountryCode();
            if (isset($countryCode))
            {
              $identifier = "$countryCode $identifier";
            }
          }

          return $identifier;
        }

        return $this->resource->identifier;

      case 'sourceCulture':

        return $this->resource->sourceCulture;
    }
  }

  public function offsetGet($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__get'), $args);
  }

  public function offsetSet($offset, $value)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__set'), $args);
  }

  public function offsetUnset($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__unset'), $args);
  }

  public static function eventTypes()
  {
    return array(QubitTerm::getById(QubitTerm::CREATION_ID),
      QubitTerm::getById(QubitTerm::ACCUMULATION_ID));
  }
}
