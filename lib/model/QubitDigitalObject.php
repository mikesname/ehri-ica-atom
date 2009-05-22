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
 * Extend functionality of propel generated "BaseDigitalObject" class
 *
 * @package    qubit
 * @subpackage model
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class QubitDigitalObject extends BaseDigitalObject
{
  // Directory for generic icons
  const GENERIC_ICON_DIR = 'generic-icons';

  // Mime-type for thumbnails (including reference image)
  const THUMB_MIME_TYPE = 'image/jpeg';
  const THUMB_EXTENSION = 'jpg';

  // List of web compatible image formats (supported in most major browsers)
  private static $webCompatibleImageFormats = array(
    'image/jpeg',
    'image/jpg',
    'image/jpe',
    'image/gif',
    'image/png'
  );

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

  public function save($connection = null)
  {
    // TODO: $cleanInformationObject = $this->getInformationObject()->clean();
    $cleanInformationObjectId = $this->columnValues['information_object_id'];

    parent::save($connection);

    if ($cleanInformationObjectId != $this->getInformationObjectId() && QubitInformationObject::getById($cleanInformationObjectId) !== null)
    {
      SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanInformationObjectId));
    }

    if ($this->getInformationObject() !== null)
    {
      SearchIndex::updateTranslatedLanguages($this->getInformationObject());
    }
  }

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

    if ($this->getInformationObject() !== null)
    {
      SearchIndex::updateTranslatedLanguages($this->getInformationObject());
    }
  }

  /**
   * Create a digital object representation of an asset
   *
   * @param mixed parent object (digital object or information object)
   * @param QubitAsset asset to represent
   * @param array options array of optional paramaters
   * @return QubitDigitalObject
   */
  public static function create($parent, $asset, $options = array())
  {
    switch (get_class($parent))
    {
      case 'QubitDigitalObject':
        $parentInformationObject = $parent->getTopAncestorOrSelf()->getInformationObject;
        break;
      case 'QubitInformationObject':
        $parentInformationObject = $parent;
        break;
      default:
        var_dump(get_class($parent));
    }

    // Fail if no valid path to information object found
    if (null === $parentInformationObject || 'QubitInformationObject' != get_class($parentInformationObject))
    {
      throw sfException('Parent object is not a valid object');
    }

    // Fail if filename is empty
    if (0 == strlen($asset->getName()))
    {
      throw sfException('Not a valid filename');
    }

    // Get usage type id (default to MASTER)
    $usageId = (isset($options['usageId'])) ? $options['usageId'] : QubitTerm::MASTER_ID;

    // Fail if asssets intended usage is a reference or thumbnail object and
    // it's *not* an image mimetype
    $isImage = QubitDigitalObject::isImageFile($asset->getName());
    if (($usageId == QubitTerm::REFERENCE_ID || $usageId == QubitTerm::THUMBNAIL_ID) && $isImage === false)
    {
      throw sfException('Reference or thumbnail asset must be mime-type image/*');
    }

    // Get clean file name (no bad chars)
    $cleanFileName = self::sanitizeFilename($asset->getName());

    // Upload paths for this information object / digital object
    $infoObjectPath = QubitDigitalObject::getAssetPathfromParent($parentInformationObject);
    $filePath       = sfConfig::get('sf_web_dir').$infoObjectPath.'/';
    $relativePath   = $infoObjectPath.'/';
    $filePathName   = $filePath.$cleanFileName;

    // make the target directory if necessary
    // NB: this will always return false if the path exists
    if (!file_exists($filePath))
    {
      mkdir($filePath, 0755, true);
    }

    // Write file
    if (false === file_put_contents($filePathName, $asset->getContents()))
    {
      throw sfException('File write to '.$filePathName.' failed');
    }

    // set file permissions
    if (!chmod($filePathName, 0644))
    {
      throw sfException('Failed to set permissions on '.$filePathName);
    }

    // Iterate through new directories and set permissions (mkdir() won't do this properly)
    $pathToDir = sfConfig::get('sf_web_dir');
    foreach (explode('/', $infoObjectPath) as $dir)
    {
      $pathToDir .= '/'.$dir;
      chmod($pathToDir, 0755);
    }

    // Save digital object in database
    $digitalObject = new QubitDigitalObject;
    $digitalObject->setName($cleanFileName);
    $digitalObject->setPath($relativePath);
    $digitalObject->setByteSize(filesize($filePathName));
    $digitalObject->setUsageId($usageId);

    if ('QubitDigitalObject' == get_class($parent))
    {
      $digitalObject->setParentId($parent->getId());
    }
    else if ('QubitInformationObject' == get_class($parent))
    {
      $digitalObject->setInformationObjectId($parent->getId());
    }

    $digitalObject->setMimeAndMediaType();
    $digitalObject->save();

    // Create child objects (derivatives)
    if ($digitalObject->getPageCount() > 1)
    {
      // If DO is a compound object, then create child objects and set to
      // display as compound object (with pager)
      $digitalObject->createCompoundChildren();
      $parentInformationObject->setDisplayAsCompoundObject(1);
      $digitalObject->createThumbnail();
    }
    else
    {
      // If DO is a single object, create various representations based on
      // intended usage
      $digitalObject->createRepresentations($usageId);
    }

    return $digitalObject;
  }


  /**
   * Populate a digital object from a resource pointed to by a URI
   * This is for, eg. importing encoded digital objects from XML
   *
   * @param string  $URI  URI pointing to the resource
   * @return boolean  success or failure
   */
  public function importAssetFromURI($URI, $usageId = QubitTerm::MASTER_ID)
  {
    // Fail if URI is empty
    if (empty($URI))
    {
      return false;
    }

    // parse URL into components and get file/base name
    $uriComponents = parse_url($URI);
    $filename = basename($uriComponents['path']);

    // Fail if filename is empty
    if (empty($filename))
    {
      return false;
    }

    // Don't import this file if it's intended usage is a reference or thumbnail object
    // and it's *not* an image mimetype
    $isImage = QubitDigitalObject::isImageFile($filename);
    if (($usageId == QubitTerm::REFERENCE_ID || $usageId == QubitTerm::THUMBNAIL_ID) && $isImage === false)
    {
      return false;
    }

    // Get clean file name (no bad chars)
    $cleanFileName = self::sanitizeFilename($filename);

    // Upload paths for this information object / digital object
    $informationObject = QubitInformationObject::getById($this->getInformationObjectId());
    $infoObjectPath    = QubitDigitalObject::getAssetPathfromParent($informationObject);
    $uploadPath        = sfConfig::get('sf_web_dir').$infoObjectPath.'/';
    $relativePath      = $infoObjectPath.'/';

    // make the target directory if necessary
    // NB: this will always return false if the path exists
    mkdir($uploadPath, 0755, true);

    $inputHandle = fopen($URI, 'rb');
    if (!$inputHandle)
    {
      return false; // unable to open URI for reading
    }

    $outputHandle = fopen($uploadPath.$cleanFileName, 'wb');
    if (!$outputHandle)
    {
      return false; // unable to open file for writing
    }

    // pass stream through one chunk at a time
    // NB: possible performance implications here
    while (!feof($inputHandle))
    {
      fwrite($outputHandle, fread($inputHandle, 8192));
    }
    fclose($inputHandle);
    fclose($outputHandle);

    // set proper permissions
    if (!chmod($uploadPath.$cleanFileName, 0644))
    {
      return false; // unable to set permissions
    }

    // Iterate through new directories and set permissions
    $pathToDir = sfConfig::get('sf_web_dir');
    foreach (explode('/', $infoObjectPath) as $dir)
    {
      $pathToDir .= '/'.$dir;

      // Don't set permissions on base uploads directory
      if ($pathToDir != sfConfig::get('sf_upload_dir'))
      {
        chmod($pathToDir, 0755);
      }
    }

    // Save digital object in database
    $this->setName($cleanFileName);
    $this->setPath($relativePath);
    $this->setByteSize(filesize($uploadPath.$cleanFileName));
    $this->setUsageId($usageId);

    $this->setMimeAndMediaType();
    $this->save();

    $this->setPageCount();
    if ($this->getPageCount() > 1)
    {
      // If DO is a compound object, then create child objects and set to
      // display as compound object (with pager)
      $this->createCompoundChildren();
      $informationObject->setDisplayAsCompoundObject(1);
      $this->createThumbnail();
    }
    else
    {
      // If DO is a single object, create various representations based on
      // intended usage
      $this->createRepresentations($usageId);
    }

    return true;
  }

  /**
   * Populate a digital object from a base64-encoded character stream.
   * This is for, eg. importing encoded digital objects from XML
   *
   * @param string  $encodedString  base64-encoded string
   * @return boolean  success or failure
   */
  public function importAssetFromBase64($encodedString, $filename, $usageId = QubitTerm::MASTER_ID)
  {
    // Fail if filename or data are empty
    if (empty($encodedString) || empty($filename))
    {
      return false;
    }

    // Don't import this file if it's intended usage is a reference or thumbnail object
    // and it's *not* an image mimetype
    $isImage = QubitDigitalObject::isImageFile($filename);
    if (($usageId == QubitTerm::REFERENCE_ID || $usageId == QubitTerm::THUMBNAIL_ID) && $isImage === false)
    {
      return false;
    }

    // Get clean file name (no bad chars)
    $cleanFileName = self::sanitizeFilename($filename);

    // Upload paths for this information object / digital object
    $informationObject = QubitInformationObject::getById($this->getInformationObjectId());
    $infoObjectPath    = QubitDigitalObject::getAssetPathfromParent($informationObject);
    $uploadPath        = sfConfig::get('sf_web_dir').$infoObjectPath.'/';
    $relativePath      = $infoObjectPath.'/';

    // make the target directory if necessary
    // NB: this will always return false if the path exists
    mkdir($uploadPath, 0755, true);

    $outputHandle = fopen($uploadPath.$cleanFileName, 'wb');
    if (!$outputHandle)
    {
      return false; // unable to open file for writing
    }

    $bytes = fwrite($outputHandle, base64_decode($encodedString));
    if (!$bytes)
    {
      return false; // unable to write to file
    }
    fclose($outputHandle);

    // set proper permissions
    if (!chmod($uploadPath.$cleanFileName, 0644))
    {
      return false; // unable to set permissions
    }

    // Iterate through new directories and set permissions
    $pathToDir = sfConfig::get('sf_web_dir');
    foreach (explode('/', $infoObjectPath) as $dir)
    {
      $pathToDir .= '/'.$dir;

      // Don't set permissions on base uploads directory
      if ($pathToDir != sfConfig::get('sf_upload_dir'))
      {
        chmod($pathToDir, 0755);
      }
    }

    // Save digital object in database
    $this->setName($cleanFileName);
    $this->setPath($relativePath);
    $this->setByteSize($bytes);
    $this->setUsageId($usageId);

    $this->setMimeAndMediaType();
    $this->save();

    $this->setPageCount();
    if ($this->getPageCount() > 1)
    {
      // If DO is a compound object, then create child objects and set to
      // display as compound object (with pager)
      $this->createCompoundChildren();
      $informationObject->setDisplayAsCompoundObject(1);
      $this->createThumbnail();
    }
    else
    {
      // If DO is a single object, create various representations based on
      // intended usage
      $this->createRepresentations($usageId);
    }

    return true;
  }

  /**
   * Remove undesirable characters from a filename
   *
   * @param string $filename incoming file name
   * @return string sanitized filename
   */
  private static function sanitizeFilename($filename)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $filename);
  }

  /**
   * Get a list of digital objects for an icon table
   *
   * @param integer  $mediaTypeId Media-type foreign key
   * @param integer  $page current Pager page
   * @return QubitPager paginated list of digital objects
   */
  public static function getIconList($mediaTypeId=null, $page=1)
  {
    $criteria = new Criteria;

    if (isset($mediaTypeId))
    {
      $criteria->add(QubitDigitalObject::MEDIA_TYPE_ID, $mediaTypeId);
    }

    // Don't show derivative Digital Objects
    $criteria->add(QubitDigitalObject::INFORMATION_OBJECT_ID, null, Criteria::ISNOTNULL);

    // Sort by name ascending
    $criteria->addAscendingOrderByColumn(QubitDigitalObject::NAME);

    $pager = new QubitPager('QubitDigitalObject', '8'); // 8 thumbs per page
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  /**
   * Get count of digital objects by media-type
   */
  public static function getCount($mediaTypeId=null)
  {
    $sql = 'SELECT COUNT(*) as hits FROM '.QubitDigitalObject::TABLE_NAME.'
    WHERE '.QubitDigitalObject::PARENT_ID.' IS NULL';

    if (isset($mediaTypeId))
    {
      $sql .= ' AND '.QubitDigitalObject::MEDIA_TYPE_ID.'='.$mediaTypeId;
    }

    $conn = Propel::getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rs = $stmt->fetch();

    return $rs['hits'];
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
   * Test that image will display in major web browsers
   *
   * @return boolean
   */
  public function isWebCompatibleImageFormat()
  {
    return in_array($this->getMimeType(), self::$webCompatibleImageFormats);
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

    $mimePieces = explode('/', $this->getMimeType());

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
  public function getTopAncestorOrSelf()
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
   * Return a compound representation for this digital object - generating the
   * rep if necessary
   *
   * @return QubitDigitalObject compound image representation
   */
  public function getCompoundRepresentation()
  {
    if (null === $compoundRep = $this->getRepresentationByUsage(QubitTerm::COMPOUND_ID))
    {
      // Generate a compound representation if one doesn't exist already
      $compoundRep = self::createImageDerivative(QubitTerm::COMPOUND_ID);
    }

    return $compoundRep;
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
   * Return true if this is a compound digital object
   *
   * @return boolean
   */
  public function isCompoundObject()
  {
    $isCompoundObjectProp = QubitProperty::getOneByObjectIdAndName($this->getId(), 'is_compound_object');

    return (null !== $isCompoundObjectProp && '1' == $isCompoundObjectProp->getValue(array('sourceCulture' => true)));
  }

  /**
   * Get a human-readable filesize for this digital asset
   *
   * @return string  bytesize of digital asset + best match for units
   */
  public function getHRfileSize()
  {
    $suffix = array( 'B', 'KB', 'MB', 'GB', 'TB' );
    $bytes = $this->getByteSize();
    $i = 0;
    while ($bytes >= 1024 && $i < (count($suffix) - 1))
    {
      $bytes /= 1024;
      $i++;
    }

    return round($bytes, 2).' '.$suffix[$i];
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
    if (array_key_exists($mimeType, $genericIconList))
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
      $ext = strtolower($ext);  // Convert uppercase extensions to lowercase

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
   * Create various representations for this digital object
   *
   * @param integer $usageId intended use of asset
   * @return QubitDigitalObject this object
   */
  public function createRepresentations($usageId)
  {
    // Scale images (and pdfs) and create derivatives
    if ($this->canThumbnail())
    {
      if ($usageId == QubitTerm::MASTER_ID)
      {
        $this->createReferenceImage();
        $this->createThumbnail();
      }
      else if ($usageId == QubitTerm::REFERENCE_ID)
      {
        $this->resizeByUsageId(QubitTerm::REFERENCE_ID);
        $this->createThumbnail();
      }
      else if ($usageId == QubitTerm::THUMBNAIL_ID)
      {
        $this->resizeByUsageId(QubitTerm::THUMBNAIL_ID);
      }
    }

    if ($this->getMediaTypeId() == QubitTerm::VIDEO_ID)
    {
      if ($usageId == QubitTerm::MASTER_ID)
      {
        $this->createVideoDerivative(QubitTerm::REFERENCE_ID);
        $this->createVideoDerivative(QubitTerm::THUMBNAIL_ID);
      }
    }

    return $this;
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

  /**
   * Set 'page_count' property for this asset
   *
   * NOTE: requires the ImageMagick library
   *
   * @return QubitDigitalObject this object
   */
  public function setPageCount()
  {
    if ($this->canThumbnail() && self::hasImageMagick())
    {
      exec('identify '.sfConfig::get('sf_web_dir').$this->getFullPath(), $output, $status);
      if ($status == 0)
      {
        // Add "number of pages" property
        $pageCount = new QubitProperty;
        $pageCount->setObjectId($this->getId());
        $pageCount->setName('page_count');
        $pageCount->setScope('digital_object');
        $pageCount->setValue(count($output), array('sourceCulture' => true));
        $pageCount->save();
      }
    }

    return $this;
  }

  /**
   * Get the number of pages in asset (multi-page file)
   *
   * @return integer number of pages
   */
  public function getPageCount()
  {
    if (null === $pageCount = QubitProperty::getOneByObjectIdAndName($this->getId(), 'page_count'))
    {
      $this->setPageCount();
      $pageCount = QubitProperty::getOneByObjectIdAndName($this->getId(), 'page_count');
    }

    if ($pageCount)
    {
      return (integer) $pageCount->getValue();
    }
  }

  /**
   * Explode multi-page asset into multiple image files
   *
   * @return unknown
   */
  public function explodeMultiPageAsset()
  {
    $pageCount = $this->getPageCount();

    if ($pageCount > 1 && $this->canThumbnail())
    {
      $filenameMinusExtension = preg_replace('/\.[a-zA-Z]{2,3}$/', '', $this->getFullPath());

      $convertStr  = 'convert -quality 100 ';
      $convertStr .= sfConfig::get('sf_web_dir').$this->getFullPath();
      $convertStr .= ' '.sfConfig::get('sf_web_dir').$filenameMinusExtension.'_%02d.'.self::THUMB_EXTENSION;

      exec($convertStr, $output, $status);

      if (false && $status == 1)
      {
        throw sfException('Encountered error: '.implode("\n".$output).' while running convert.');
      }

      // Build an array of the exploded file names
      for ($i = 0; $i < $pageCount; $i++)
      {
        $fileList[] = sfConfig::get('sf_web_dir').$filenameMinusExtension.sprintf('_%02d.', $i).self::THUMB_EXTENSION;
      }
    }

    return $fileList;
  }

  /**
   * Create an info and digital object tree for multi-page assets
   *
   * For digital objects that describe a multi-page digital asset (e.g. a
   * multi-page tif image), create a derived asset for each page, create a child
   * information object and linked child digital object and move the derived
   * asset to the appropriate directory for the new (child) info object
   *
   * NOTE: Requires the Imagemagick library for creating derivative assets
   *
   * @return QubitDigitalObject this object
   */
  public function createCompoundChildren()
  {
    // Bail out if the imagemagick library is not installed
    if (false === self::hasImageMagick())
    {
      return $this;
    }

    $pages = $this->explodeMultiPageAsset();

    foreach ($pages as $i => $filepath)
    {
      // Create a new information object
      $newInfoObject = new QubitInformationObject;
      $newInfoObject->setParentId($this->getInformationObject()->getId());
      $newInfoObject->setTitle($this->getInformationObject()->getTitle().' ('.($i + 1).')');
      $newInfoObject->save();

      // Create and link a new digital object
      $newDigiObject = new QubitDigitalObject;
      $newDigiObject->setParentId($this->getId());
      $newDigiObject->setInformationObjectId($newInfoObject->getId());
      $newDigiObject->save();

      // Derive new file path based on newInfoObject
      $assetPath = self::getAssetPathfromParent($newInfoObject);
      $createPath = '';
      foreach (explode('/', $assetPath) as $d)
      {
        $createPath .= '/'.$d;
        if (!is_dir(sfConfig::get('sf_web_dir').$createPath))
        {
          mkdir(sfConfig::get('sf_web_dir').$createPath, 0755);
        }
        chmod(sfConfig::get('sf_web_dir').$createPath, 0755);
      }

      // Derive new name for file based on original file name + newDigitalObject
      // id
      $filename = basename($filepath);
      $newFilepath = sfConfig::get('sf_web_dir').$assetPath.'/'.$filename;

      // Move asset to new name and path
      rename($filepath, $newFilepath);
      chmod($newFilepath, 0644);

      // Save new file information
      $newDigiObject->setPath($assetPath.'/');
      $newDigiObject->setName($filename);
      $newDigiObject->setByteSize(filesize($newFilepath));
      $newDigiObject->setUsageId(QubitTerm::MASTER_ID);
      $newDigiObject->setMimeType(QubitDigitalObject::deriveMimeType($filename));
      $newDigiObject->setMediaTypeId($this->getMediaTypeId());
      $newDigiObject->setPageCount();
      $newDigiObject->setSequence($i + 1);
      $newDigiObject->save();

      // And finally create reference and thumb images for child asssets
      $newDigiObject->createRepresentations($newDigiObject->getUsageId());
    }

    return $this;
  }

  /**
   * Test various php settings that affect file upload size and report the
   * most limiting one.
   *
   * @return integer max upload file size in bytes
   */
  public static function getMaxUploadSize()
  {
    $post_max_size = self::returnBytes(ini_get('post_max_size'));
    $upload_max_filesize = self::returnBytes(ini_get('upload_max_filesize'));

    if ($memory_limit = ini_get('memory_limit'))
    {
      $memory_limit = self::returnBytes($memory_limit);

      return min($post_max_size, $upload_max_filesize, $memory_limit);
    }
    else
    {

      return min($post_max_size, $upload_max_filesize);
    }
  }

  /**
   * Transform the php.ini notation for numbers (like '2M') to number of bytes
   *
   * Taken from http://ca2.php.net/manual/en/function.ini-get.php
   *
   * @param string $value A string denoting byte size by multiple (e.g. 2M)
   * @return integer size in bytes
   */
  private static function returnBytes($val)
  {
    $val = trim($val);
    $last = strtolower(substr($val, -1));
    switch($last) {
      // The 'G' modifier is available since PHP 5.1.0
      case 'g':
        $val *= 1024;
      case 'm':
        $val *= 1024;
      case 'k':
        $val *= 1024;
    }

    return $val;
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
    $extension = '.'.self::THUMB_EXTENSION;

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
      $maxwidth = (sfConfig::get('app_reference_image_maxwidth')) ? sfConfig::get('app_reference_image_maxwidth') : 480;
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
        if (!$maxwidth = sfConfig::get('app_reference_image_maxwidth'))
        {
          $maxwidth = 480;
        }
        $maxheight = $maxwidth;
        break;
      case QubitTerm::THUMBNAIL_ID:
        $maxwidth = 100;
        $maxheight = 100;
        break;
      case QubitTerm::COMPOUND_ID:
        if (!$maxwidth = sfConfig::get('app_reference_image_maxwidth'))
        {
          $maxwidth = 480;
        }
        $maxheight = $maxwidth; // Full maxwidth dimensions (480 default)
        $maxwidth = floor($maxwidth / 2) - 10; // 1/2 size - gutter (230 default)
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
    $newImage = new sfThumbnail($width, $height, true, false, 75, $adapter, array('extract' => 1));
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
        $extension = '.'.self::THUMB_EXTENSION;
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

    // Do conversion to jpeg
    $cmd = 'ffmpeg -i '.$originalPath.' -vframes 1 -an -f image2 -s '.$width.'x'.$height.' '.$newPath;
    exec($cmd.' 2>&1', $stdout, $returnValue);

    // If return value is non-zero, an error occured
    if ($returnValue)
    {
      return false;
    }

    return true;
  }
}
