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
 * Ingest an uploaded file and import it as an object w/relations
 *
 * @package    qubit
 * @subpackage import/export
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 * @author     MJ Suhonos <mj@artefactual.com>
 */
class ObjectImportAction extends sfAction
{
  public function execute($request)
  {
    $this->timer = new QubitTimer;
    $file = $request->getFiles('file');

    // if we got here without a file upload, go to file selection
    if (!isset($file))
    {
      $this->redirect(array('module' => 'object', 'action' => 'importSelect'));
    }

    // set indexing preference
    if ($request->getParameter('noindex'))
    {
      QubitSearch::getInstance()->disabled = true;
    }
    else
    {
      QubitSearch::getInstance()->getEngine()->enableBatchMode();
    }

    try
    {
      // choose import type based on file extension, eg. csv, xml
      if ('csv' == pathinfo($file['name'], PATHINFO_EXTENSION))
      {
        $importer = new QubitCsvImport;
        $importer->import($file['tmp_name'], array('schema' => $request->getParameter('schema')));
      }
      elseif ('xml' == pathinfo($file['name'], PATHINFO_EXTENSION))
      {
        $importer = new QubitXmlImport;
        $importer->import($file['tmp_name'], array('strictXmlParsing' => false));
      }
      elseif ('zip' == pathinfo($file['name'], PATHINFO_EXTENSION) && class_exists('ZipArchive'))
      {
        $zipFolder = $file['tmp_name'].'-zip';
        if (!file_exists($zipFolder))
        {
          mkdir($zipFolder, 0755);
        }

        // extract the zip archive into the temporary folder
        // TODO: need some error handling here
        $zip = new ZipArchive();
        $zip->open($file['tmp_name']);
        $zip->extractTo($zipFolder);
        $zip->close();

        $files = $this->dir_tree($zipFolder);

        // this code is from lib/importBulkTask.class.php
        foreach ($files as $import_file)
        {
          // try to free up memory
          unset($importer);

          // choose import type based on file extension, eg. csv, xml
          if ('csv' == pathinfo($import_file, PATHINFO_EXTENSION))
          {
            $importer = new QubitCsvImport;
            $importer->import($import_file, array('schema'));
          }
          elseif ('xml' == pathinfo($import_file, PATHINFO_EXTENSION))
          {
            $importer = new QubitXmlImport;
            $importer->import($import_file, array('strictXmlParsing' => false));
          }
          else
          {
            // move on to the next file
            continue;
          }
        }
      }
      else
      {
        $this->context->user->setFlash('error', $this->context->i18n->__('Unable to import selected file'));
        $this->redirect(array('module' => 'object', 'action' => 'importSelect'));
      }
    }
    catch (sfException $e)
    {
      $this->context->user->setFlash('error', $e->getMessage());
      $this->redirect(array('module' => 'object', 'action' => 'importSelect'));
    }

    // optimize index if enabled
    if (!$request->getParameter('noindex'))
    {
      QubitSearch::getInstance()->getEngine()->optimize();
    }

    $this->errors = $importer->getErrors();
    $this->rootObject = $importer->getRootObject();
    $this->objectType = strtr(get_class($this->rootObject), array('Qubit' => ''));
  }

  protected function dir_tree($dir)
  {
    $path = '';
    $stack[] = $dir;
    while ($stack) 
    {
      $thisdir = array_pop($stack);
      if ($dircont = scandir($thisdir))
      {
        $i=0;
        while (isset($dircont[$i]))
        {
          if ($dircont[$i] !== '.' && $dircont[$i] !== '..'
            // ignore system/hidden files
            && !preg_match('/^\..*/', $dircont[$i]))
          {
            $current_file = "{$thisdir}/{$dircont[$i]}";
            if (is_file($current_file))
            {
              $path[] = "{$thisdir}/{$dircont[$i]}";
            }
            elseif (is_dir($current_file))
            {
              $stack[] = $current_file;
            }
          }
          $i++;
        }
      }
    }

    return $path;
  }
}
