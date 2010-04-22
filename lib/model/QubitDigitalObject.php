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

  // Variables for save actions
  public
    $assets = array(),
    $indexOnSave = true,
    $createDerivatives = true;

  // Temporary path for local copy of an external object (see importFromUri method)
  protected $localPath;

  // List of web compatible image formats (supported in most major browsers)
  protected static $webCompatibleImageFormats = array(
    'image/jpeg',
    'image/jpg',
    'image/jpe',
    'image/gif',
    'image/png'
  );

  // Qubit Generic Icon list
  protected static $qubitGenericThumbs = array(
    'application/x-msaccess'        => 'icon-ms-access.gif',
    'application/vnd.ms-excel'      => 'icon-ms-excel.gif',
    'application/msword'            => 'icon-ms-word.gif',
    'application/vnd.ms-powerpoint' => 'icon-ms-powerpoint.gif'
  );

  protected static $qubitGenericReference = array(
    '*/*' => 'no_reference_rep.png'
  );

  /*
   * The following mime-type array is taken from the Gallery 2 project
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

  public function __toString()
  {
    return (string) $this->name;
  }

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    switch ($name)
    {
      case 'thumbnail':

        if (!isset($this->values['thumbnail']))
        {
          $criteria = new Criteria;
          $criteria->add(QubitDigitalObject::PARENT_ID, $this->__get('id'));
          $criteria->add(QubitDigitalObject::USAGE_ID, QubitTerm::THUMBNAIL_ID);

          $this->values['thumbnail'] = QubitDigitalObject::get($criteria)->offsetGet(0);
        }

        return $this->values['thumbnail'];
    }

    return call_user_func_array(array($this, 'BaseDigitalObject::__get'), $args);
  }

  public function save($connection = null)
  {
    // TODO: $cleanInformationObject = $this->informationObject->clean;
    $cleanInformationObjectId = $this->__get('informationObjectId', array('clean' => true));

    // Write assets to storage device
    if (0 < count($this->assets))
    {
      foreach ($this->assets as $asset)
      {
        if (null == $this->getChecksum() || $asset->getChecksum() != $this->getChecksum())
        {
          $this->writeToFileSystem($asset);
        }

        // TODO: allow setting multiple assets for different usage types
        // (e.g. a master, thumbnail and reference image)
        break;
      }
    }

    parent::save($connection);

    // Create child objects (derivatives)
    if (0 < count($this->assets) && $this->createDerivatives)
    {
      if ($this->getPageCount() > 1)
      {
        // If DO is a compound object, then create child objects and set to
        // display as compound object (with pager)
        $this->createCompoundChildren();

        // Set parent digital object to be displayed as compound
        $this->setDisplayAsCompoundObject(1);

        // We don't need reference image because a compound will be displayed instead of it
        // But thumbnails are necessary for image flow
        $this->createThumbnail();
      }
      else
      {
        // If DO is a single object, create various representations based on
        // intended usage
        $this->createRepresentations($this->usageId);
      }
    }

    // Add watermark to reference image
    if (QubitTerm::REFERENCE_ID == $this->usageId
        && $this->isImage()
        && is_readable($waterMarkPathName = sfConfig::get('sf_web_dir').'/watermark.png')
        && is_file($waterMarkPathName))
    {
      $filePathName = sfConfig::get('sf_web_dir').$this->getFullPath();
      $command = 'composite -dissolve 15 -tile '.$waterMarkPathName.' '.escapeshellarg($filePathName).' '.escapeshellarg($filePathName);
      exec($command);
    }

    // Update search index for related info object
    if ($this->indexOnSave)
    {
      if ($this->informationObjectId != $cleanInformationObjectId && null !== QubitInformationObject::getById($cleanInformationObjectId))
      {
        SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanInformationObjectId));
      }

      if (isset($this->informationObject))
      {
        SearchIndex::updateTranslatedLanguages($this->informationObject);
      }
    }

    return $this;
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
  public function writeToFileSystem($asset, $options = array())
  {
    // Fail if filename is empty
    if (0 == strlen($asset->getName()))
    {
      throw new sfException('Not a valid filename');
    }

    if (null == ($parentInformationObject = $this->getInformationObject()))
    {
      $parentInformationObject = $this->getParent()->getInformationObject();
    }

    // Fail if no valid parent information object found
    if (null == $parentInformationObject)
    {
      throw new sfException('No valid parent was set for this digital object.');
    }

    // Fail if asset's intended usage is a reference or thumbnail object and
    // it's *not* an image mimetype
    $isImage = QubitDigitalObject::isImageFile($asset->getName());
    if (($this->getUsageId() == QubitTerm::REFERENCE_ID || $this->getUsageId() == QubitTerm::THUMBNAIL_ID) && $isImage === false)
    {
      throw new sfException('Reference or thumbnail asset must be mime-type image/*');
    }

    // Get clean file name (no bad chars)
    $cleanFileName = self::sanitizeFilename($asset->getName());

    // If file has not extension, try to get it from asset mime type
    if (0 == strlen(pathinfo($cleanFileName, PATHINFO_EXTENSION)) && null !== ($assetMimeType = $asset->getMimeType()) && 0 < strlen(($newFileExtension = array_search($assetMimeType, self::$qubitMimeTypes))))
    {
      $cleanFileName .= '.'.$newFileExtension;
    }

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

    // Test asset checksum against generated checksum from file
    $this->generateChecksumFromFile($filePathName);
    if ($this->getChecksum() != $asset->getChecksum())
    {
      unlink($filePathName);
      rmdir($infoObjectPath);

      throw new sfException('Checksum values did not validate.');
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
    $this->setName($cleanFileName);
    $this->setPath($relativePath);
    $this->setByteSize(filesize($filePathName));
    $this->setMimeAndMediaType();

    return $this;
  }


  /**
   * Populate a digital object from a resource pointed to by a URI
   * This is for, eg. importing encoded digital objects from XML
   *
   * @param string  $uri  URI pointing to the resource
   * @return boolean  success or failure
   */
  public function importFromURI($uri, $options = array())
  {
    // Parse URL into components and get file/base name
    $uriComponents = parse_url($uri);

    // Initialize web browser
    $browser = new sfWebBrowser(array(), null, array('Timeout' => 3));

    // Add asset to digital object assets array
    if (true !== $browser->get($uri)->responseIsError() && 0 < strlen(($filename = basename($uriComponents['path']))))
    {
      $asset = new QubitAsset($uri, $browser->getResponseText());

      $this->assets[] = $asset;
    }
    else
    {
      throw new sfException();
    }

    // Set digital object as external URI
    $this->usageId = QubitTerm::EXTERNAL_URI_ID;

    // Save filestream temporary, because sfImageMagickAdapter does not support load data from streams
    $this->localPath = Qubit::saveTemporaryFile($filename, $asset->getContents());

    $this->name = $filename;
    $this->path = $uri;
    $this->checksum = $asset->getChecksum();
    $this->byteSize = strlen($browser->getResponseText());
    $this->setMimeAndMediaType();
  }

  /**
   * Populate a digital object from a base64-encoded character stream.
   * This is for, eg. importing encoded digital objects from XML
   *
   * @param string  $encodedString  base64-encoded string
   * @return boolean  success or failure
   */
  public function importFromBase64($encodedString, $filename, $options = array())
  {
    $fileContents = base64_decode($encodedString);

    if (0 < strlen($fileContents))
    {
      $asset = new QubitAsset($filename, $fileContents);
    }
    else
    {
      throw new sfException('Could not read the file contents');
    }

    $this->assets[] = $asset;
  }

  /**
   * Remove undesirable characters from a filename
   *
   * @param string $filename incoming file name
   * @return string sanitized filename
   */
  protected static function sanitizeFilename($filename)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $filename);
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
  public function setMimeAndMediaType($mimeType = null)
  {
    if (null !== $mimeType)
    {
      $this->setMimeType($mimeType);
    }
    else
    {
      $this->setMimeType(QubitDigitalObject::deriveMimeType($this->getName()));
    }

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
  public static function getGenericIconPath($mimeType, $usageType)
  {
    $genericIconDir  = self::GENERIC_ICON_DIR;
    $matchedMimeType = null;

    switch ($usageType)
    {
      case QubitTerm::REFERENCE_ID:
      case QubitTerm::MASTER_ID:
        $genericIconList = QubitDigitalObject::$qubitGenericReference;
        break;
      default:
        $genericIconList = QubitDigitalObject::$qubitGenericThumbs;
    }

    // Check the list for a generic icon matching this mime-type
    $mimeParts = explode('/', $mimeType);
    foreach ($genericIconList as $mimePattern => $icon)
    {
      $pattern = explode('/', $mimePattern);

      if (($mimeParts[0] == $pattern[0] || '*' == $pattern[0]) && ($mimeParts[1] == $pattern[1] || '*' == $pattern[1]))
      {
        $matchedMimeType = $mimePattern;
        break;
      }
    }

    if (null !== $matchedMimeType)
    {
      $genericIconPath = $genericIconDir.'/'.$genericIconList[$matchedMimeType];
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
  public static function getGenericRepresentation($mimeType, $usageType)
  {
    $representation = new QubitDigitalObject;
    $genericIconPath = QubitDigitalObject::getGenericIconPath($mimeType, $usageType);

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
      if ($usageId == QubitTerm::EXTERNAL_URI_ID || $usageId == QubitTerm::MASTER_ID)
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
      if (QubitTerm::EXTERNAL_URI_ID == $this->usageId)
      {
        $command = 'identify '.$this->localPath;
      }
      else
      {
        $command = 'identify '.sfConfig::get('sf_web_dir').$this->getFullPath();
      }

      exec($command, $output, $status);

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
    if (null === $pageCount = QubitProperty::getOneByObjectIdAndName($this->id, 'page_count'))
    {
      $this->setPageCount();
      $pageCount = QubitProperty::getOneByObjectIdAndName($this->id, 'page_count');
    }

    if ($pageCount)
    {
      return (integer) $pageCount->getValue();
    }
  }

  public function getPage($index)
  {
    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::PARENT_ID, $this->informationObject->id, Criteria::EQUAL);
    $criteria->addJoin(QubitInformationObject::ID, QubitDigitalObject::INFORMATION_OBJECT_ID);
    $criteria->setLimit(1);
    $criteria->setOffset($index);

    return QubitDigitalObject::getOne($criteria);
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
      if (QubitTerm::EXTERNAL_URI_ID == $this->usageId)
      {
        $path = $this->localPath;
      }
      else
      {
        $path = sfConfig::get('sf_web_dir').$this->getFullPath();
      }

      $filenameMinusExtension = preg_replace('/\.[a-zA-Z]{2,3}$/', '', $path);

      $command = 'convert -quality 100 ';
      $command .= $path;
      $command .= ' '.$filenameMinusExtension.'_%02d.'.self::THUMB_EXTENSION;
      exec($command, $output, $status);

      if ($status == 1)
      {
        throw new sfException('Encountered error'.(is_array($output) && count($output) > 0 ? ': '.implode('\n'.$output) : ' ').' while running convert (ImageMagick).');
      }

      // Build an array of the exploded file names
      for ($i = 0; $i < $pageCount; $i++)
      {
        $fileList[] = $filenameMinusExtension.sprintf('_%02d.', $i).self::THUMB_EXTENSION;
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
    $settings = array();
    $settings[] = self::returnBytes(ini_get('post_max_size'));
    $settings[] = self::returnBytes(ini_get('upload_max_filesize'));
    $settings[] = self::returnBytes(ini_get('memory_limit'));

    foreach ($settings as $index => $value)
    {
      if ($value == 0)
      {
        unset($settings[$index]);
      }
    }

    if (0 == count($settings))
    {
      // Unlimited
      return -1;
    }
    else
    {
      return min($settings);
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
  protected static function returnBytes($val)
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
   * Create an derivative of an image (a smaller image ;)
   *
   * @param integer  $usageId  usage type id
   * @return QubitDigitalObject derivative object
   */
  public function createImageDerivative($usageId)
  {
    // Get max dimensions
    $maxDimensions = self::getImageMaxDimensions($usageId);

    // Build new filename and path
    if (QubitTerm::EXTERNAL_URI_ID == $this->usageId)
    {
      $originalFullPath = $this->localPath;
    }
    else
    {
      $originalFullPath = sfConfig::get('sf_web_dir').$this->getFullPath();
    }

    $extension = '.'.self::THUMB_EXTENSION;
    list($originalNameNoExtension) = explode('.', $this->getName());
    $derivativeName = $originalNameNoExtension.'_'.$usageId.$extension;

    // Resize
    $resizedImage = QubitDigitalObject::resizeImage($originalFullPath, $maxDimensions[0], $maxDimensions[1]);

    if (0 < strlen($resizedImage))
    {
      $derivative = new QubitDigitalObject;
      $derivative->setParentId($this->getId());
      $derivative->setUsageId($usageId);
      $derivative->createDerivatives = false;
      $derivative->indexOnSave = false;
      $derivative->assets[] = new QubitAsset($derivativeName, $resizedImage);
      $derivative->save();

      return $derivative;
    }
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
      return QubitDigitalObject::resizeImage($filename, $maxwidth, $maxheight);
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
   * @param integer $width
   * @param integer $height
   *
   * @return string (thumbnail's bitstream)
   */
  public static function resizeImage($originalImageName, $width=null, $height=null)
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
    try
    {
      $newImage = new sfThumbnail($width, $height, true, false, 75, $adapter, array('extract' => 1));
      $newImage->loadFile($originalImageName);
    }
    catch (Exception $e)
    {
      return false;
    }

    return $newImage->toString('image/jpeg');
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
    $command = 'convert -version';
    exec($command, $output, $status);

    return 0 < count($output) && false !== strpos($output[0], 'ImageMagick');
  }

  /**
   * Test if GD Extension for PHP is installed
   *
   * @return boolean true if GD extension found
   */
  public static function hasGdExtension()
  {
    return extension_loaded('gd');
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
   * Create video derivatives (either flv movie or thumbnail)
   *
   * @param integer  $usageId  usage type id
   * @return QubitDigitalObject derivative object
   */
  public function createVideoDerivative($usageId)
  {
    // Build new filename and path
    $originalFullPath = sfConfig::get('sf_web_dir').$this->getFullPath();
    list($originalNameNoExtension) = explode('.', $this->getName());

    switch ($usageId)
    {
      case QubitTerm::REFERENCE_ID:
        $derivativeName = $originalNameNoExtension.'_'.$usageId.'.flv';
        $derivativeFullPath = sfConfig::get('sf_web_dir').$this->getPath().$derivativeName;
        self::convertVideoToFlash($originalFullPath, $derivativeFullPath);
        break;
      case QubitTerm::THUMBNAIL_ID:
      default:
        $extension = '.'.self::THUMB_EXTENSION;
        $derivativeName = $originalNameNoExtension.'_'.$usageId.$extension;
        $derivativeFullPath = sfConfig::get('sf_web_dir').$this->getPath().$derivativeName;
        $maxDimensions = self::getImageMaxDimensions($usageId);
        self::convertVideoToThumbnail($originalFullPath, $derivativeFullPath, $maxDimensions[0], $maxDimensions[1]);
    }

    if (file_exists($derivativeFullPath) && 0 < ($byteSize = filesize($derivativeFullPath)))
    {
      $derivative = new QubitDigitalObject;
      $derivative->setPath($this->getPath());
      $derivative->setName($derivativeName);
      $derivative->setParentId($this->getId());
      $derivative->setByteSize($byteSize);
      $derivative->setUsageId($usageId);
      $derivative->setMimeAndMediaType();
      $derivative->createDerivatives = false;
      $derivative->indexOnSave = false;
      $derivative->save();

      return $derivative;
    }
  }

  /**
   * Test if FFmpeg library is installed
   *
   * @return boolean  true if FFmpeg is found
   */
  public static function hasFfmpeg()
  {
    $command = 'ffmpeg -version 2>&1';
    exec($command, $output, $status);

    return 0 < count($output) && false !== strpos($output[0], 'FFmpeg');
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

    $command = 'ffmpeg -y -i '.$originalPath.' '.$newPath.' 2>&1';
    exec($command, $output, $status);

    // If return value is non-zero, an error occured
    if ($status)
    {
      throw new sfException($command.' '.$output.' '.$status);
    }

    chmod($newPath, 0644);

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
  public static function convertVideoToThumbnail($originalPath, $newPath, $width = null, $height = null)
  {
    // Test for FFmpeg library
    if (!self::hasFfmpeg())
    {
      return false;
    }

    // Do conversion to jpeg
    $command = 'ffmpeg -i '.$originalPath.' -vframes 1 -an -f image2 -s '.$width.'x'.$height.' '.$newPath;
    exec($command.' 2>&1', $output, $status);

    // If return value is non-zero, an error occured
    if ($status)
    {
      throw new sfException($command.' '.$output.' '.$status);
    }

    chmod($newPath, 0644);

    return true;
  }

  /**
   * Return true if derived mimeType is "video/*"
   *
   * @param string $filename
   * @return boolean
   */
  public static function isVideoFile($filename)
  {
    $mimeType = self::deriveMimeType($filename);
    if (strtolower(substr($mimeType, 0, 5)) == 'video')
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  /**
   * Create a thumbnail from a video file using FFmpeg library
   *
   * @param string $originalImageName
   * @param integer $width
   * @param integer $height
   *
   * @return string (thumbnail's bitstream)
   */
  public static function createThumbnailFromVideo($originalPath, $width=null, $height=null)
  {
    // Test for FFmpeg library
    if (!self::hasFfmpeg())
    {

      return false;
    }

    $tmpDir = sfConfig::get('sf_upload_dir').'/tmp';
    if (!file_exists($tmpDir))
    {
      mkdir($tmpDir);
      chmod($tmpDir, 0775);
    }

    // Get a unique file name (to avoid clashing file names)
    $tmpFileName = null;
    $tmpFilePath = null;
    while (file_exists($tmpFilePath) || null === $tmpFileName)
    {
      $uniqueString = substr(md5(time().$tmpFileName), 0, 8);
      $tmpFileName = 'TMP'.$uniqueString;
      $tmpFilePath = $tmpDir.'/'.$tmpFileName.'.jpg';
    }

    // Do conversion to jpeg
    $command = 'ffmpeg -i '.$originalPath.' -vframes 1 -an -f image2 -s '.$width.'x'.$height.' '.$tmpFilePath.' 2>&1';
    exec($command, $output, $status);

    // If return value is non-zero, an error occured
    if ($status)
    {
      throw new sfException($command.' '.$output.' '.$status);
    }

    chmod($tmpFilePath, 0644);

    return file_get_contents($tmpFilePath);
  }

  /* -----------------------------------------------------------------------
   * CHECKSUMS
   * --------------------------------------------------------------------- */

  /**
   * Set a checksum value for this digital object
   *
   * @param string $value   the checksum string
   * @param array  $options optional parameters
   *
   * @return QubitDigitalObject this object
   */
  public function setChecksum($value, $options)
  {
    if (isset($options['checksumTypeId']))
    {
      $this->setChecksumTypeId($options['checksumTypeId']);
    }

    $this->checksum = $value;

    return $this;
  }

  /**
   * Generate a checksum from the file specified
   *
   * @param string $filename name of file
   * @return string checksum
   */
  public function generateChecksumFromFile($filename)
  {
    switch($this->checksumTypeId)
    {
      case 'sha1':
        $this->checksum = sha1_file($filename);
        //$this->checksumTypeId = QubitTerm::CHECKSUM_SHA1_ID;
        break;
      case 'md5':
      default:
        $this->checksum = md5_file($filename);
        //$this->checksumTypeId = QubitTerm::CHECKSUM_MD5_ID;
    }

    return $this;
  }

  /* -----------------------------------------------------------------------
   * Display as compound object
   * --------------------------------------------------------------------- */

  /**
   * Setter for "displayAsCompound" property
   *
   * @param string $value new value for property
   * @return QubitInformationObject this object
   */
  public function setDisplayAsCompoundObject($value)
  {
    $criteria = new Criteria;
    $criteria->add(QubitProperty::OBJECT_ID, $this->id, Criteria::EQUAL);
    $criteria->add(QubitProperty::NAME, 'displayAsCompound');

    $displayAsCompoundProp = QubitProperty::getOne($criteria);
    if (is_null($displayAsCompoundProp))
    {
      $displayAsCompoundProp = new QubitProperty;
      $displayAsCompoundProp->setObjectId($this->getId());
      $displayAsCompoundProp->setName('displayAsCompound');
    }

    $displayAsCompoundProp->setValue($value, array('sourceCulture' => true));
    $displayAsCompoundProp->save();

    return $this;
  }

  /**
   * Getter for related "displayAsCompound" property
   *
   * @return string property value
   */
  public function getDisplayAsCompoundObject()
  {
    $displayAsCompoundProp = QubitProperty::getOneByObjectIdAndName($this->getId(), 'displayAsCompound');
    if (null !== $displayAsCompoundProp)
    {

      return $displayAsCompoundProp->getValue(array('sourceCulture' => true));
    }
  }

  /**
   * Decide whether to show child digital objects as a compound object based
   * on 'displayAsCompound' toggle and available digital objects.
   *
   * @return boolean
   */
  public function showAsCompoundDigitalObject()
  {
    // Return false if this digital object is not linked directly to an
    // information object
    if (null === $this->informationObjectId)
    {

      return false;
    }

    // Return false if "show compound" toggle is not set to '1' (yes)
    $showCompoundProp = QubitProperty::getOneByObjectIdAndName($this->getId(), 'displayAsCompound');
    if (null === $showCompoundProp || '1' != $showCompoundProp->getValue(array('sourceCulture' => true)) )
    {

      return false;
    }

    // Return false if this object has no children with digital objects
    $criteria = new Criteria;
    $criteria->addJoin(QubitInformationObject::ID, QubitDigitalObject::INFORMATION_OBJECT_ID, Criteria::INNER_JOIN);
    $criteria->add(QubitInformationObject::PARENT_ID, $this->informationObjectId, Criteria::EQUAL);

    if (0 === count(QubitDigitalObject::get($criteria)))
    {

      return false;
    }

    return true;
  }
}
