<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * Digital Object upload component
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class DigitalObjectUploadComponent extends sfComponent
{
  /**
   * Get a list of digital objects attached to the current information object
   * @param  sfRequest         The current sfRequest object
   */
  public function execute($request)
  {
    if (!isset($this->usageId))
    {
      $this->usageId = QubitTerm::MASTER_ID;
    }
  }

  /**
   * Save digitalObject asset (file) to the appropriate directory
   *
   * @param  sfRequest         The current sfRequest object
   * @param  informationObject The associated informationObject
   *
   * @return mixed  array of file metadata on sucess, false on failure
   */
  static function uploadAsset($request, $informationObject, $usageId)
  {
    $uploadFiles = $request->getFiles('upload_file');
    $filename = $uploadFiles['name'][$usageId];

    // Fail if upload file not specified
    if (!$filename)
    {
      return false;
    }

    // Don't upload this file if it's intended usage is a reference or thumbnail object,
    // And it's *not* an image mimetype
    $isImage = QubitDigitalObject::isImageFile($filename);
    if (($usageId == QubitTerm::REFERENCE_ID || $usageId == QubitTerm::THUMBNAIL_ID) && $isImage === false)
    {
      return false;
    }

    // Get clean file name (no bad chars)
    $cleanFileName = DigitalObjectUploadComponent::sanitizeFile($filename);

    // Upload paths for this information object / digital object
    $infoObjectPath    = QubitDigitalObject::getAssetPathfromParent($informationObject);
    $uploadPath        = sfConfig::get('sf_web_dir').$infoObjectPath.'/';
    $relativePath      = $infoObjectPath.'/';

    // Upload the file
    if (!$request->moveFile('upload_file['.$usageId.']', $uploadPath.$cleanFileName, 0644, true, 0755))
    {
      return false; // File creation error
    }

    // Iterate through new directories and set permissions
    // (bug in sfWebRequest::moveFile() only sets permissions properly on final directory)
    $pathToDir = sfConfig::get('sf_web_dir');
    foreach (explode('/',$infoObjectPath) as $dir)
    {
      $pathToDir .= '/'.$dir;

      // Don't set permissions on base uploads directory
      if ($pathToDir != sfConfig::get('sf_upload_dir'))
      {
        chmod($pathToDir, 0755);
      }
    }

    // Capture and return file data
    $fileData = array(
      'name'=>$cleanFileName,
      'path'=>$relativePath,
      'fullpath'=>$relativePath.$cleanFileName,
      'size'=>$uploadFiles['size'][$usageId],
      'mime-type-request'=>$uploadFiles['type'][$usageId], // passed from webserver? may be incorrect
    );

    return $fileData;
  }

  static function sanitizeFile($file)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $file);
  }
}