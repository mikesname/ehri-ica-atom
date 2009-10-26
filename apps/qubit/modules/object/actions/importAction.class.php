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
    $options = array();

    // should we do strict validation? (recommended)
    // TODO: this should be an application-level setting
    $options['strictXmlParsing'] = true;

    require_once sfConfig::get('sf_symfony_lib_dir').'/plugins/sfCompat10Plugin/lib/request/sfRequestCompat10.class.php';
    $this->dispatcher->connect('request.method_not_found', array('sfRequestCompat10', 'call'));

    // Check for import file
    if (strlen($this->getRequest()->getFilePath('file')) > 0)
    {
      $xmlStream = file_get_contents($this->getRequest()->getFilePath('file'));
    }
    else
    {
      $this->errors = sfContext::getInstance()->getI18N()->__('No import file selected, or the selected file exceeds the maximum upload size.');

      return sfView::ERROR;
    }

    // Try import
    try
    {
      $this->import = QubitXmlImport::execute($xmlStream, $options);
    }
    catch (Exception $e)
    {
      $this->errors = $e->getMessage();

      return sfView::ERROR;
    }

    // FIXME: Redirect depends on single or multiple object import!
    $this->objectType = strtr(get_class($this->import->getRootObject()), array('Qubit' => ''));

    return sfView::SUCCESS;
  }
}
