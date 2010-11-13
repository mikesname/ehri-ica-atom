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

class DigitalObjectUploadAction extends sfAction
{
  public function execute($request)
  {
    // Check user authorization
    $this->informationObject = QubitInformationObject::getById($request->informationObjectId);
    if (!QubitAcl::check($this->informationObject, 'update'))
    {
      throw new sfException;
    }

    ProjectConfiguration::getActive()->loadHelpers('Qubit');

    $uploadFiles = array();
    $warning = null;

    // Create tmp dir, if it doesn't exist already
    $tmpDir = sfConfig::get('sf_upload_dir').'/tmp';
    if (!file_exists($tmpDir))
    {
      mkdir($tmpDir);
      chmod($tmpDir, 0775);
    }

    foreach ($_FILES as $file)
    {
      // Get file extension
      $extension = substr($file['name'], strrpos($file['name'], '.'));

      // Get a unique file name (to avoid clashing file names)
      do
      {
        $uniqueString = substr(md5(time().$file['name']), 0, 8);
        $tmpFileName = "TMP$uniqueString$extension";
        $tmpFilePath = "$tmpDir/$tmpFileName";
      }
      while (file_exists($tmpFilePath));

      // Thumbnail name
      $thumbName = "THB$uniqueString.jpg";
      $thumbPath = "$tmpDir/$thumbName";

      // Move file to web/uploads/tmp directory
      if (!move_uploaded_file($file['tmp_name'], $tmpFilePath))
      {
        $errorMessage = $this->context->i18n->__('File %1% could not be moved to %2%', array('%1%' => $file['name'], '%2%' => $tmpDir));
        $uploadFiles[] = array('error' => $errorMessage);

        continue;
      }

      $tmpFileMd5sum = md5_file($tmpFilePath);
      $tmpFileMimeType = QubitDigitalObject::deriveMimeType($tmpFileName);

      if ($canThumbnail = QubitDigitalObject::canThumbnailMimeType($tmpFileMimeType) || QubitDigitalObject::isVideoFile($tmpFilePath))
      {
        if (QubitDigitalObject::isImageFile($tmpFilePath) || 'application/pdf' == $tmpFileMimeType)
        {
          $resizedObject = QubitDigitalObject::resizeImage($tmpFilePath, 150, 150);
        }
        else if (QubitDigitalObject::isVideoFile($tmpFilePath))
        {
          $resizedObject = QubitDigitalObject::createThumbnailFromVideo($tmpFilePath, 150, 150);
        }

        if (0 < strlen($resizedObject))
        {
          file_put_contents($thumbPath, $resizedObject);
          chmod($thumbPath, 0644);
        }

        // Show a warning message if object couldn't be thumbnailed when it is
        // supposed to be possible
        if (!file_exists($thumbPath) && 0 >= filesize($thumbPath))
        {
          $warning = $this->context->i18n->__('File %1% could not be thumbnailed', array('%1%' => $file['name']));
        }
      }
      else
      {
        $thumbName = '../../images/'.QubitDigitalObject::getGenericIconPath($tmpFileMimeType, QubitTerm::THUMBNAIL_ID);
      }

      $uploadFiles = array(
        'canThumbnail' => $canThumbnail,
        'name' => $file['name'],
        'md5sum' => $tmpFileMd5sum,
        'size' => hr_filesize($file['size']),
        'thumb' => $thumbName,
        'tmpName' => $tmpFileName,
        'warning' => $warning);
    }

    // Pass file data back to caller for processing on form submit
    $this->response->setHttpHeader('Content-Type', 'application/json; charset=utf-8');

    return $this->renderText(json_encode($uploadFiles));
  }
}
