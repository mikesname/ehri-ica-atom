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
 * Ingest an uploaded file and import it as an object w/relations
 *
 * @package    qubit
 * @subpackage import/export
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class ObjectImportAction extends sfAction
{
  public function execute($request)
  {
    $this->timer = new QubitTimer;

    try
    {
      $this->import = QubitXmlImport::execute(file_get_contents($_FILES['file']['tmp_name']), array('strictXmlParsing' => true));
    }
    catch (sfException $e)
    {
      $this->context->user->setFlash('error', $e->getMessage());

      $this->redirect(array('module' => 'object', 'action' => 'importSelect'));
    }

    $this->objectType = strtr(get_class($this->import->getRootObject()), array('Qubit' => ''));
  }
}
