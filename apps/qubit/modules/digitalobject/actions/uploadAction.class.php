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

    sfContext::getInstance()->getConfiguration()->loadHelpers('Qubit');

    $uploadFiles = array();
    $warning = null;

    foreach ($_FILES as $file)
    {
      // Tmp dir
      $tmpDir = sfConfig::get('sf_upload_dir').'/tmp';
      if (!file_exists($tmpDir))
      {
        mkdir($tmpDir);
        chmod($tmpDir, 0775);
      }

      // Get file extension
      $extension = substr($file['name'], strrpos($file['name'], '.'));

      // Get a unique file name (to avoid clashing file names)
      $tmpFileName = null;
      $tmpFilePath = null;
      while (file_exists($tmpFilePath) || null === $tmpFileName)
      {
        $uniqueString = substr(md5(time().$file['name']), 0, 8);
        $tmpFileName = 'TMP'.$uniqueString.$extension;
        $tmpFilePath = $tmpDir.'/'.$tmpFileName;
      }

      // Thumbnail name
      $thumbName = 'THB'.$uniqueString.'.jpg';
      $thumbPath = $tmpDir.'/'.$thumbName;

      // Move file to web/uploads/tmp directory
      if (!move_uploaded_file($file['tmp_name'], $tmpFilePath))
      {
        $errorMessage = $this->getContext()->getI18N()->__('File %1% could not be moved to %2%', array('%1%' => $file['name'], '%2%' => $tmpDir));
        $uploadFiles[] = array('error' => $errorMessage);
        continue;
      }

      $tmpFileMd5sum = md5_file($tmpFilePath);
      $tmpFileMimeType = QubitDigitalObject::deriveMimeType($tmpFileName);

      if ($canThumbnail = QubitDigitalObject::canThumbnailMimeType($tmpFileMimeType) || QubitDigitalObject::isVideoFile($tmpFilePath))
      {
        $resizedObject;

        if (QubitDigitalObject::isImageFile($tmpFilePath) || $tmpFileMimeType == 'application/pdf')
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

        // Show a warning message if object couldn't be thumbnailed when it is supposed to be possible
        if (!file_exists($thumbPath) && 0 >= filesize($thumbPath))
        {
          $warning = $this->getContext()->getI18N()->__('File %1% could not be thumbnailed', array('%1%' => $file['name']));
        }
      }
      else
      {
        $thumbName = '../../images/'.QubitDigitalObject::getGenericIconPath($tmpFileMimeType, QubitTerm::THUMBNAIL_ID);
      }

      $uploadFiles = array(
        'name' => $file['name'],
        'tmpName' => $tmpFileName,
        'md5sum' => $tmpFileMd5sum,
        'thumb' => $thumbName,
        'size' => hr_filesize($file['size']),
        'canThumbnail' => $canThumbnail,
        'warning' => $warning
      );
    }

    // Pass file data back to caller for processing on form submit
    $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
    return $this->renderText(json_encode($uploadFiles));
  }
}
