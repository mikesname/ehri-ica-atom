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
 * Digital Object coverflow component
 *
 * @package    qubit
 * @subpackage digitalobject
 * @version    SVN: $Id$
 * @author     david juhasz <david@artefactual.com>
 */
class DigitalObjectImageflowComponent extends sfComponent
{
  public function execute($request)
  {
    $this->getResponse()->addStylesheet('imageflow');
    $this->getResponse()->addJavaScript('imageflow');

    foreach ($this->thumbnails as $thumbnail)
    {
      // If object has a related information object, get it
      if ($parentInfoObject = $thumbnail->getInformationObject())
      {
        $informationObjects[] = $parentInfoObject;
      }

      // Else, if it's a derived image (no related info object) get parent digital
      // object, and grab *that* related info object
      else if ($parentInfoObject = $thumbnail->getParent()->getInformationObject())
      {
        $informationObjects[] = $parentInfoObject;
      }
    }

    $this->informationObjects = $informationObjects;
  }
}