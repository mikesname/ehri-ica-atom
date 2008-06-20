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
 * Extend functionality of propel generated "BaseDigitalObject" class.
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class QubitDigitalObject extends BaseDigitalObject
{
  // Directory for generic icons
  const GENERIC_ICON_DIR = 'generic-icons';

  // Mime-type for thumbnails (including reference image)
  const THUMB_MIME_TYPE = 'image/png';

  // Qubit Generic Icon list
  private static $qubitGenericIcons = array(
    'application/x-msaccess'        => 'icon-ms-access.gif',
    'application/vnd.ms-excel'      => 'icon-ms-excel.gif',
    'application/msword'            => 'icon-ms-word.gif',
    'application/vnd.ms-powerpoint' => 'icon-ms-powerpoint.gif'
  );

  /*
   * Pulled the following mime-type array from the Gallery 2 project
   * http://gallery.menalto.com
   */
  public static $qubitMimeTypes = array(
    /* This data was lifted from Apache's mime.types listing. */
    'z' => 'application/x-compress',
    'ai' => 'application/postscript',
    'aif' => 'audio/x-aiff',
    'aifc' => 'audio/x-aiff',
    'aiff' => 'audio/x-aiff',
    'asc' => 'text/plain',
    'au' => 'audio/basic',
    'avi' => 'video/x-msvideo',
    'bcpio' => 'application/x-bcpio',
    'bin' => 'application/octet-stream',
    'bmp' => 'image/bmp',
    'cdf' => 'application/x-netcdf',
    'class' => 'application/octet-stream',
    'cpio' => 'application/x-cpio',
    'cpt' => 'application/mac-compactpro',
    'csh' => 'application/x-csh',
    'css' => 'text/css',
    'dcr' => 'application/x-director',
    'dir' => 'application/x-director',
    'djv' => 'image/vnd.djvu',
    'djvu' => 'image/vnd.djvu',
    'dll' => 'application/octet-stream',
    'dms' => 'application/octet-stream',
    'doc' => 'application/msword',
    'dvi' => 'application/x-dvi',
    'dxr' => 'application/x-director',
    'eps' => 'application/postscript',
    'etx' => 'text/x-setext',
    'exe' => 'application/octet-stream',
    'ez' => 'application/andrew-inset',
    'gif' => 'image/gif',
    'gtar' => 'application/x-gtar',
    'gz' => 'application/x-gzip',
    'hdf' => 'application/x-hdf',
    'hqx' => 'application/mac-binhex40',
    'ice' => 'x-conference/x-cooltalk',
    'ief' => 'image/ief',
    'iges' => 'model/iges',
    'igs' => 'model/iges',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'jpe' => 'image/jpeg',
    'js' => 'application/x-javascript',
    'kar' => 'audio/midi',
    'latex' => 'application/x-latex',
    'lha' => 'application/octet-stream',
    'lzh' => 'application/octet-stream',
    'm3u' => 'audio/x-mpegurl',
    'man' => 'application/x-troff-man',
    'me' => 'application/x-troff-me',
    'mesh' => 'model/mesh',
    'mid' => 'audio/midi',
    'midi' => 'audio/midi',
    'mif' => 'application/vnd.mif',
    'mov' => 'video/quicktime',
    'movie' => 'video/x-sgi-movie',
    'mp2' => 'audio/mpeg',
    'mp3' => 'audio/mpeg',
    'mpe' => 'video/mpeg',
    'mpeg' => 'video/mpeg',
    'mpg' => 'video/mpeg',
    'mpga' => 'audio/mpeg',
    'ms' => 'application/x-troff-ms',
    'msh' => 'model/mesh',
    'mxu' => 'video/vnd.mpegurl',
    'nc' => 'application/x-netcdf',
    'oda' => 'application/oda',
    'pbm' => 'image/x-portable-bitmap',
    'pdb' => 'chemical/x-pdb',
    'pdf' => 'application/pdf',
    'pgm' => 'image/x-portable-graymap',
    'pgn' => 'application/x-chess-pgn',
    'png' => 'image/png',
    'pnm' => 'image/x-portable-anymap',
    'ppm' => 'image/x-portable-pixmap',
    'ppt' => 'application/vnd.ms-powerpoint',
    'ps' => 'application/postscript',
    'qt' => 'video/quicktime',
    'ra' => 'audio/x-realaudio',
    'ram' => 'audio/x-pn-realaudio',
    'ras' => 'image/x-cmu-raster',
    'rgb' => 'image/x-rgb',
    'rm' => 'audio/x-pn-realaudio',
    'roff' => 'application/x-troff',
    'rpm' => 'audio/x-pn-realaudio-plugin',
    'rtf' => 'text/rtf',
    'rtx' => 'text/richtext',
    'sgm' => 'text/sgml',
    'sgml' => 'text/sgml',
    'sh' => 'application/x-sh',
    'shar' => 'application/x-shar',
    'silo' => 'model/mesh',
    'sit' => 'application/x-stuffit',
    'skd' => 'application/x-koan',
    'skm' => 'application/x-koan',
    'skp' => 'application/x-koan',
    'skt' => 'application/x-koan',
    'smi' => 'application/smil',
    'smil' => 'application/smil',
    'snd' => 'audio/basic',
    'so' => 'application/octet-stream',
    'spl' => 'application/x-futuresplash',
    'src' => 'application/x-wais-source',
    'sv4cpio' => 'application/x-sv4cpio',
    'sv4crc' => 'application/x-sv4crc',
    'svg' => 'image/svg+xml',
    'swf' => 'application/x-shockwave-flash',
    't' => 'application/x-troff',
    'tar' => 'application/x-tar',
    'tcl' => 'application/x-tcl',
    'tex' => 'application/x-tex',
    'texi' => 'application/x-texinfo',
    'texinfo' => 'application/x-texinfo',
    'tif' => 'image/tiff',
    'tiff' => 'image/tiff',
    'tr' => 'application/x-troff',
    'tsv' => 'text/tab-separated-values',
    'txt' => 'text/plain',
    'ustar' => 'application/x-ustar',
    'vcd' => 'application/x-cdlink',
    'vrml' => 'model/vrml',
    'vsd' => 'application/vnd.visio',
    'wav' => 'audio/x-wav',
    'wbmp' => 'image/vnd.wap.wbmp',
    'wbxml' => 'application/vnd.wap.wbxml',
    'wml' => 'text/vnd.wap.wml',
    'wmlc' => 'application/vnd.wap.wmlc',
    'wmls' => 'text/vnd.wap.wmlscript',
    'wmlsc' => 'application/vnd.wap.wmlscriptc',
    'wrl' => 'model/vrml',
    'xbm' => 'image/x-xbitmap',
    'xls' => 'application/vnd.ms-excel',
    'xpm' => 'image/x-xpixmap',
    'xsl' => 'text/xml',
    'xwd' => 'image/x-xwindowdump',
    'xyz' => 'chemical/x-xyz',
    'zip' => 'application/zip',

    /* And additions from Gallery2 - http://codex.gallery2.org  */
    /* From support.microsoft.com/support/kb/articles/Q284/0/94.ASP */
    'asf' => 'video/x-ms-asf',
    'asx' => 'video/x-ms-asx',
    'wmv' => 'video/x-ms-wmv',
    'wma' => 'audio/x-ms-wma',

    /* JPEG 2000: From RFC 3745: http://www.faqs.org/rfcs/rfc3745.html */
    'jp2' => 'image/jp2',
    'jpg2' => 'image/jp2',
    'jpf' => 'image/jpx',
    'jpx' => 'image/jpx',
    'mj2' => 'video/mj2',
    'mjp2' => 'video/mj2',
    'jpm' => 'image/jpm',
    'jpgm' => 'image/jpgm',

    /* Other */
    'psd' => 'application/photoshop',
    'pcd' => 'image/x-photo-cd',
    'jpgcmyk' => 'image/jpeg-cmyk',
    'tifcmyk' => 'image/tiff-cmyk',
    'wmf' => 'image/wmf',
    'tga' => 'image/tga',
    'flv' => 'video/x-flv',
    'mp4' => 'video/mp4',
    'tgz' => 'application/x-compressed'
  );

  /**
   * Override base delete method to unlink related digital assets (thumbnail
   * and file)
   *
   * @param  sfConnection  A database connection
   */
  public function delete($connection = null)
  {
    $criteria = new Criteria;
    $criteria->add(QubitDigitalObject::PARENT_ID, $this->getId());

    $children = QubitDigitalObject::get($criteria);

    // Delete children
    foreach ($children as $child)
    {
      $child->delete();
    }

    // Delete digital asset
    if ($assetPath = $this->getFullPath())
    {
      if (file_exists(sfConfig::get('sf_web_dir').$assetPath))
      {
        unlink(sfConfig::get('sf_web_dir').$assetPath);
      }
    }

    // Delete self
    parent::delete($connection);
  }

  /**
   * Get full path to asset, relative to the web directory
   *
   * @return string  path to asset
   */
  public function getFullPath()
  {
    return $this->getPath().$this->getName();
  }

  /**
   * Set Mime-type and Filetype all at once
   *
   */
  public function setMimeAndMediaType()
  {
    $this->setMimeType(QubitDigitalObject::deriveMimeType($this->getName()));
    $this->setDefaultMediaType();
  }

  /**
   * Set default mediaTypeId based on digital asset's mime-type.  Media types
   * id's are defined in the QubitTerms db
   *
   * @return mixed  integer if mediatype mapped, null if no valid mapping
   */
  public function setDefaultMediaType()
  {
    // Make sure we have a valid mime-type (with a forward-slash).
    if (!strlen($this->getMimeType()) || !strpos($this->getMimeType(), '/'))
    {
      return null;
    }

    $mimePieces = explode('/',$this->getMimeType());

    switch($mimePieces[0])
    {
      case 'audio':
        $mediaTypeId = QubitTerm::AUDIO_ID; 
        break;
      case 'image':
        $mediaTypeId = QubitTerm::IMAGE_ID; 
        break;
      case 'text':
        $mediaTypeId = QubitTerm::TEXT_ID; 
        break;
      case 'video':
        $mediaTypeId = QubitTerm::VIDEO_ID; 
        break;
      case 'application':
        switch ($mimePieces[1])
        {
          case 'pdf':
            $mediaTypeId = QubitTerm::TEXT_ID; 
            break;
          default:
            $mediaTypeId = QubitTerm::OTHER_ID;
        }
        break;
      default:
       $mediaTypeId = QubitTerm::OTHER_ID;
    }

    $this->setMediaTypeId($mediaTypeId);
  }

  /**
   * Get this object's top ancestor, or self if it is the top of the branch
   *
   * return QubitInformationObject  Closest InformationObject ancestor
   */
  public function getTopAncestorOrSelf ()
  {
    // Get the ancestor at array index "0"
    return $this->getAncestors()->andSelf()->offsetGet(0);
  }

  /**
   * Find *first* child of current digital object that matches $usageid.
   *
   * @param integer  Constant value from QubitTerm (THUMBNAIL_ID, REFERENCE_ID)
   */
  public function getChildByUsageId($usageId)
  {
    $criteria = new Criteria;
    $criteria->add(QubitDigitalObject::PARENT_ID, $this->getId());
    $criteria->add(QubitDigitalObject::USAGE_ID, $usageId);

    $result = QubitDigitalObject::getOne($criteria);

    return $result;
  }

  /**
   * Get a representation for the given $usageId.  Currently only searches
   * direct children of current digital object.
   *
   * @param integer $usageId
   * @return mixed DigitalObject on success
   *
   * @todo look for matching usage id up and down object tree?
   */
  public function getRepresentationByUsage($usageId)
  {
    if ($usageId == $this->getUsageId())
    {
      return $this;
    }
    else
    {
      return $this->getChildByUsageId($usageId);
    }
  }

  /**
   * Determine if this digital object is an image, based on mimetype
   *
   * @return boolean
   */
  public function isImage()
  {
    return self::isImageFile($this->getName());
  }

  /**
   * Resize this digital object (image)
   *
   * @param integer $maxwidth  Max width of resized image
   * @param integer $maxheight Max height of resized image
   *
   * @return boolean success or failure
   */
  public function resize($maxwidth, $maxheight=null)
  {
    // Only operate on digital objects that are images
    if ($this->isImage())
    {
      $filename = sfConfig::get('sf_web_dir').$this->getFullPath();
      return QubitDigitalObject::resizeImage($filename, $filename, $maxwidth, $maxheight);
    }

    return false;
  }

  /**
   * Resize current digital object according to a specific usage type
   *
   * @param integer $usageId
   * @return boolean success or failure
   */
  public function resizeByUsageId($usageId)
  {
    if ($usageId == QubitTerm::REFERENCE_ID)
    {
      $maxwidth = (sfConfig::get('reference_image_maxwidth')) ? sfConfig::get('reference_image_maxwidth') : 480;
      $maxheight = null;
    }
    else if ($usageId == QubitTerm::THUMBNAIL_ID)
    {
      $maxwidth = 100;
      $maxheight = 100;
    }
    else
    {
      return false;
    }

    return $this->resize($maxwidth, $maxheight);
  }

  /**
   * Get a human-readable filesize for this digital asset
   *
   * @return string  bytesize of digital asset + best match for units
   */
  public function getHRfileSize()
  {
    $suffix = array( 'B', 'KB', 'MB', 'GB', 'TB' );
    $bytes = parent::getByteSize();
    for ($i = 0; $bytes >= 1024 && $i < (count($suffix)-1); $bytes /= 1024, $i++)
    {
    }

    return round($bytes, 2).' '.$suffix[$i];
  }

  /**
   * Set a related row in the DigitalObjectMetaData db, identified by $name, to
   * $value. If the element doesn't already exist, create it
   *
   * @param string    key for meta-data element
   * @param string    new value for meta-data element
   * @return integer  return primary key value
   */
  public function setMetaDataValue($name, $value)
  {
    // Test for existing element with $name
    $criteria = new Criteria;
    $criteria->add(QubitDigitalObjectMetadata::DIGITAL_OBJECT_ID, $this->getId());
    $criteria->add(QubitDigitalObjectMetadata::ELEMENT, $name);
    $foundElement = QubitDigitalObjectMetadata::get($criteria);

    // Get existing meta-data element, else create a new one
    if (is_array($foundElement))
    {
      $metaData = $foundElement;
    }
    else
    {
      $metaData = new QubitDigitalObjectMetadata;
    }

    // Update database
    $metaData->setDigitalObjectId($this->getId());
    $metaData->setElement($name);
    $metaData->setValue($value);
    $metaData->save();

    return $metaData->getId();
  }

  /**
   * Get the current value of the meta-data row identified by $name
   * in the DigitalObjectMetaData db
   *
   * @param string  key for meta-data element
   * @return mixed  string value on success, false on failure
   */
  public function getMetadataValue($elementName = null)
  {
    $criteria = new Criteria;
    $criteria->add(QubitDigitalObjectMetadata::DIGITAL_OBJECT_ID, $this->getId());

    if (!is_null($elementName))
    {
      $criteria->add(QubitDigitalObjectMetadata::ELEMENT, $elementName);
    }
    $results = QubitDigitalObjectMetadata::getOne($criteria);

    if ($results)
    {
      return $results->getValue();
    }
    else
    {
      return false;
    }
  }

  /**
   * Derive file path for a digital object asset.  All digital object paths are
   * keyed by information object id that is the nearest ancestor of the current
   * digital object. Because we may not know the id of the current digital
   * object yet (i.e. it hasn't been saved to the database yet), we pass
   * the parent digital object or information object.
   *
   * @param mixed    Parent (QubitDigitalObject or QubitInformationObject)
   * @return string  asset file path
   */
  public static function getAssetPathfromParent($parentObject)
  {
    $uploadPathRelative = sfConfig::get('app_upload_dir');

    if (get_class($parentObject) == 'QubitDigitalObject')
    {
      $infoObject = $parentObject->getAncestorInformationObject();
      $infoObjectId = (string) $infoObject->getId();
    }
    else if (get_class($parentObject) == 'QubitInformationObject')
    {
      $infoObjectId = (string) $parentObject->getId();
    }
    else
    {
      return false;
    }

    // To keep to a minimum the number of sub-directories in the uploads dir,
    // we break up information object path by using first and second digits of
    // the information object id as sub-directories.
    // e.g. if infoObjectId=3235 then path='uploads/3/2/3235/'
    $assetPath = '/'.$uploadPathRelative.'/'.$infoObjectId[0].'/'.$infoObjectId[1].'/'.$infoObjectId;

    return $assetPath;
  }

  /**
   * Get path to the appropriate generic icon for $mimeType
   *
   * @param string $mimeType
   * @return string
   */
  private static function getGenericIconPath($mimeType)
  {
    $genericIconDir  = self::GENERIC_ICON_DIR;
    $genericIconList = QubitDigitalObject::$qubitGenericIcons;

    // Check the list for a generic icon matching this mime-type
    if (array_key_exists($mimeType,$genericIconList))
    {
      $genericIconPath = $genericIconDir.'/'.$genericIconList[$mimeType];
    }
    else
    {
      // Use "blank" icon for unknown file types
      $genericIconPath = $genericIconDir.'/blank.png';
    }

    return $genericIconPath;
  }

  /**
   * Get a generic representation for the current digital object.
   *
   * @param string $mimeType
   * @return QubitDigitalObject
   */
  public static function getGenericRepresentation($mimeType)
  {
    $representation = new QubitDigitalObject;
    $genericIconPath = QubitDigitalObject::getGenericIconPath($mimeType);

    $representation->setPath(dirname($genericIconPath).'/');
    $representation->setName(basename($genericIconPath));

    return $representation;
  }

  /**
   * Derive a file's mime-type from it's filename extension.  The extension may
   * lie, but this should be "good enough" for the majority of cases.
   *
   * @param string   name of the file
   * @return string  mime-type of file (or "unknown" if no match)
   */
  public static function deriveMimeType($filename)
  {
    $mimeType     = 'unknown';
    $mimeTypeList = QubitDigitalObject::$qubitMimeTypes; // point to "master" mime-type array

    $filePieces = explode('.', basename($filename));
    array_splice($filePieces, 0, 1); // cut off "name" part of filename, leave extension(s)
    $rfilePieces = array_reverse($filePieces);  // Reverse the extension list

    // Go through extensions backwards, return value based on first hit
    // (assume last extension is most significant)
    foreach ($rfilePieces as $key => $ext)
    {
      // Try to match this extension to a mime-type
      if (array_key_exists($ext, $mimeTypeList))
      {
         $mimeType = $mimeTypeList[$ext];
         break;
      }
    }

    return $mimeType;
  }

  /**
   * Generic method for:
   * - creating a new derivative object,
   * - building a derivative asset filename,
   * - creating the derived asset,
   * - saving the derived asset's metadata
   *
   * @param callback $mechanism   callback function for creating derivative asset
   * @param string $extension     extension for derivative filename
   * @param integer $usageId      usage type for derivative
   * @param array $parameters     an array of parameters to pass to $mechanism
   *
   * @return mixed QubitDigitalObject on success, false on failure
   */
  public function createDerivative($mechanism, $extension, $parameters=array())
  {
    // Create new digital object for thumbnail (derivative)
    // And save it to db so we can put primary key in derivative name
    $derivative = new QubitDigitalObject;
    $derivative->setParentId($this->getId());
    $derivative->save();

    // Build new filename and path
    $originalFullPath = sfConfig::get('sf_web_dir').$this->getFullPath();
    list($originalNameNoExtension) = explode('.', $this->getName());
    $derivativeName = $originalNameNoExtension.'_'.$derivative->getId().$extension;
    $derivativeFullPath = sfConfig::get('sf_web_dir').$this->getPath().$derivativeName;

    // Build array of parameters to pass to mechanism for creating derivative asset
    $parameters = array_merge(array($originalFullPath, $derivativeFullPath), $parameters);

    // Create the derivative
    if (!call_user_func_array($mechanism, $parameters))
    {
      $derivative->delete();

      return false;
    }
    
    // Set permissions on output file
    chmod($derivativeFullPath, 0644);

    // Update digital object with thumbnail information
    $derivative->setName($derivativeName);
    $derivative->setPath($this->getPath());
    $derivative->setByteSize(filesize($derivativeFullPath));
    $derivative->setMimeAndMediaType();

    // Save the digital object
    $derivative->save();

    return $derivative;
  }

  /*
   * -----------------------------------------------------------------------
   * IMAGE MANIPULATION METHODS
   * -----------------------------------------------------------------------
   */

  /**
   * Create a thumbnail derivative for the current digital object
   *
   * @return QubitDigitalObject
   */
  public function createThumbnail()
  {
    // Create a thumbnail
    $derivative = $this->createImageDerivative(QubitTerm::THUMBNAIL_ID);

    return $derivative;
  }

  /**
   * Create a reference derivative for the current digital object
   *
   * @return QubitDigitalObject  The new derived reference digital object
   */
  public function createReferenceImage()
  {
    // Create derivative
    $derivative = $this->createImageDerivative(QubitTerm::REFERENCE_ID);

    return $derivative;
  }

  /**
   * Image file wrapper for calling createDerivative()
   *
   * @param integer  $usageId  usage type id
   * @return mixed QubitDigitalObject on success, false on failure
   *
   * @see QubitDigitalObject::createDerivative()
   */
  public function createImageDerivative($usageId)
  {
    $mechanism = array('QubitDigitalObject', 'resizeImage');
    $extension = '.png';

    // Get max dimensions
    $maxDimensions = self::getImageMaxDimensions($usageId);

    if ($derivative = $this->createDerivative($mechanism, $extension, $maxDimensions))
    {
      $derivative->setUsageId($usageId);
      $derivative->save();

      return $derivative;
    }

    return false;
  }

  /**
   * Allow multiple ways of getting the max dimensions for image by usage
   *
   * @param integer $usageId  the usage type
   * @return array $maxwidth, $maxheight
   *
   * @todo Add THUMBNAIL_MAX_DIMENSION to Qubit Settings
   */
  public static function getImageMaxDimensions($usageId)
  {
    $maxwidth = $maxheight = null;

    switch ($usageId)
    {
      case QubitTerm::REFERENCE_ID:
        // Backwards compatiblity - if maxwidth Qubit setting doesn't exist
        if (!$maxwidth = sfConfig::get('reference_image_maxwidth'))
        {
          $maxwidth = 480;
        }
        break;
      case QubitTerm::THUMBNAIL_ID:
        $maxwidth = 100;
        $maxheight = 100;
        break;
    }

    return array($maxwidth, $maxheight);
  }

  /**
   * Resize an image using the sfThubmnail Plugin.
   *
   * @param string $originalImageName
   * @param string $newImageName
   * @param integer $width
   * @param integer $height
   *
   * @return boolean  success or failure
   */
  private static function resizeImage($originalImageName, $newImageName, $width=null, $height=null)
  {
    $mimeType = QubitDigitalObject::deriveMimeType($originalImageName);

    // Get thumbnail adapter
    if (!$adapter = self::getThumbnailAdapter())
    {
      return false;
    }

    // Check that this file can be thumbnailed, or return false
    if (self::canThumbnailMimeType($mimeType) == false)
    {
      return false;
    }

    // Create a thumbnail
    $newImage = new sfThumbnail($width, $height, true, false, 75, $adapter);
    $newImage->loadFile($originalImageName);
    $newImage->save($newImageName, self::THUMB_MIME_TYPE);

    // Test that file was created
    if (!file_exists($newImageName))
    {
      return false;
    }

    // Set access to thumbnail
    chmod($newImageName, 0744);

    // Return true on success
    return true;
  }

  /**
   * Get a valid adapter for the sfThumbnail library (either GD or ImageMagick)
   *
   * @return mixed  name of adapter on success, false on failure
   */
  public static function getThumbnailAdapter()
  {
    $adapter = false;
    if (QubitDigitalObject::hasImageMagick())
    {
      $adapter = 'sfImageMagickAdapter';
    }
    else if (QubitDigitalObject::hasGdExtension())
    {
      $adapter = 'sfGDAdapter';
    }

    return $adapter;
  }

  /**
   * Test if ImageMagick library is installed
   *
   * @return boolean  true if ImageMagick is found
   */
  public static function hasImageMagick()
  {
    $found = false;

    exec('convert -version', $stdout);
    if (count($stdout) && strpos($stdout[0], 'ImageMagick') !== false)
    {
       $found = true;
    }

    return $found;
  }

  /**
   * Test if GD Extension for PHP is installed
   *
   * @return boolean true if GD extension found
   */
  public static function hasGdExtension()
  {
    $found = false;
    if (extension_loaded('gd'))
    {
      $found = true;
    }

    return $found;
  }

  /**
   * Wrapper for canThumbnailMimeType() for use on instantiated objects
   *
   * @return boolean
   * @see canThumbnailMimeType
   */
  public function canThumbnail()
  {
    return self::canThumbnailMimeType($this->getMimeType());
  }

  /**
   * Test if current digital object can be thumbnailed
   *
   * @param string    The current thumbnailing adapter
   * @return boolean  true if thumbnail is possible
   */
  public static function canThumbnailMimeType($mimeType)
  {
    if (!$adapter = self::getThumbnailAdapter())
    {
      return false;
    }

    $canThumbnail = false;

    // For Images, we can create thumbs with either GD or ImageMagick
    if (substr($mimeType, 0, 5) == 'image' && strlen($adapter))
    {
      $canThumbnail = true;
    }

    // For PDFs we can only create thumbs with ImageMagick
    else if ($mimeType == 'application/pdf' && $adapter == 'sfImageMagickAdapter')
    {
      $canThumbnail = true;
    }

    return $canThumbnail;
  }

  /**
   * Return true if derived mimeType is "image/*"
   *
   * @param string $filename
   * @return boolean
   */
  public static function isImageFile($filename)
  {
    $mimeType = self::deriveMimeType($filename);
    if (strtolower(substr($mimeType, 0, 5)) == 'image')
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  /*
   * -----------------------------------------------------------------------
   * VIDEO
   * -----------------------------------------------------------------------
   */

  /**
   * Video file wrapper for calling createDerivative()
   *
   * @param integer  $usageId  usage type id
   * @return mixed QubitDigitalObject on success, false on failure
   *
   * @see QubitDigitalObject::createDerivative()
   */
  public function createVideoDerivative($usageId)
  {
    
    
    switch ($usageId)
    {
      case QubitTerm::REFERENCE_ID:
        $mechanism = array('QubitDigitalObject', 'convertVideoToFlash');
        $extension = '.flv';
        $maxDimensions = array(null, null);
        break;
      case QubitTerm::THUMBNAIL_ID:
      default:
        $mechanism = array('QubitDigitalObject', 'convertVideoToThumbnail');
        $extension = '.png';
        $maxDimensions = self::getImageMaxDimensions($usageId);
        break;
    }  

    if ($derivative = $this->createDerivative($mechanism, $extension, $maxDimensions))
    {
      $derivative->setUsageId($usageId);
      $derivative->save();

      return $derivative;
    }

    return false;
  }

  /**
   * Test if ImageMagick library is installed
   *
   * @return boolean  true if ImageMagick is found
   */
  public static function hasFfmpeg()
  {
    $found = true;

    exec('ffmpeg -version', $stdout);
    if (count($stdout) && strpos($stdout[0], 'FFmpeg') !== false)
    {
       $found = true;
    }

    return $found;
  }

  
  /**
   * Create a flash video derivative using the FFmpeg library.
   *
   * @param string  $originalPath path to original video
   * @param string  $newPath      path to derivative video
   * @param integer $maxwidth     derivative video maximum width
   * @param integer $maxheight    derivative video maximum height
   *
   * @return boolean  success or failure
   *
   * @todo implement $maxwidth and $maxheight constraints on video
   */
  public static function convertVideoToFlash($originalPath, $newPath, $width=null, $height=null)
  {
    // Test for FFmpeg library
    if (!self::hasFfmpeg())
    {
      
      return false;
    }

    exec('ffmpeg -y -i '.$originalPath.' '.$newPath.' 2>&1', $stdout, $returnValue);
    
    // If return value is non-zero, an error occured
    if ($returnValue)
    {

      return false;
    }

    return true;
  }
  
  
  /**
   * Create a flash video derivative using the FFmpeg library.
   *
   * @param string  $originalPath path to original video
   * @param string  $newPath      path to derivative video
   * @param integer $maxwidth     derivative video maximum width
   * @param integer $maxheight    derivative video maximum height
   *
   * @return boolean  success or failure
   *
   * @todo implement $maxwidth and $maxheight constraints on video
   */
  public static function convertVideoToThumbnail($originalPath, $newPath, $width=null, $height=null)
  {
    // Test for FFmpeg library
    if (!self::hasFfmpeg())
    {
      
      return false;
    }
    
    // Do conversion to png
    $cmd = 'ffmpeg -i '.$originalPath.' -vcodec png -vframes 1 -an -f rawvideo -s '.$width.'x'.$height.' '.$newPath; 
    exec($cmd.' 2>&1', $stdout, $returnValue);

    // If return value is non-zero, an error occured
    if ($returnValue)
    {
     
      return false;
    }

    return true;
  }
  
}
