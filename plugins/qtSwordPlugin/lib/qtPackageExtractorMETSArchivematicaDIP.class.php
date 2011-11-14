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

class qtPackageExtractorMETSArchivematicaDIP
{
  protected
    $directory = null,
    $filename = null,
    $document = null,
    $format = null,
    $type = null,
    $resource = null;

  public
    $informationObject;

  public function __construct(array $options = array())
  {
    if (isset($options['filename']))
    {
      $this->filename = $options['filename'];
    }

    if (isset($options['name']))
    {
      $this->name = $options['name'];
    }

    if (isset($options['format']))
    {
      $this->format = $options['format'];
    }

    if (isset($options['type']))
    {
      $this->type = $options['type'];
    }

    if (isset($options['resource']))
    {
      $this->resource = $options['resource'];
    }
  }

  protected function processDmdSec($xml, $informationObject = null)
  {
    if (!isset($informationObject))
    {
      $informationObject = new QubitInformationObject;
    }

    foreach ($xml->xpath('.//mdWrap/xmlData/dublincore/*') as $item)
    {
      $value = $item->__toString();
      if (0 == strlen(trim($value)))
      {
        continue;
      }

      switch(str_replace('dcterms:', '', $item->getName()))
      {
        case 'title':
          $informationObject->title = $value;

          break;

        case 'creator':
          $informationObject->setActorByName($value, array('event_type_id' => QubitTerm::CREATION_ID));

          break;

        case 'coverage':
          $informationObject->setAccessPointByName($value, array('type_id' => QubitTaxonomy::PLACE_ID));

          break;

        case 'subject':
          $informationObject->setAccessPointByName($value, array('type_id' => QubitTaxonomy::SUBJECT_ID));

          break;

        case 'description':
          $informationObject->scopeAndContent = $value;

          break;

        case 'publisher':
          $informationObject->setActorByName($value, array('event_type_id' => QubitTerm::PUBLICATION_ID));

          break;

        case 'contributor':
          $informationObject->setActorByName($value, array('event_type_id' => QubitTerm::CONTRIBUTION_ID));

          break;

        case 'date':
          $informationObject->setDates($value);

          break;

        case 'type':
          foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DC_TYPE_ID) as $item)
          {
            if (strtolower($value) == strtolower($item->__toString()))
            {
              $relation = new QubitObjectTermRelation;
              $relation->term = $item;

              $informationObject->objectTermRelationsRelatedByobjectId[] = $relation;

              break;
            }
          }

          break;

        case 'format':
          $informationObject->extentAndMedium = $value;

          break;

        case 'identifier':
          $informationObject->identifier = $value;

          break;

        case 'source':
          $informationObject->locationOfOriginals = $value;

          break;

        case 'language':
          $informationObject->language = array($value);

          break;

        case 'isPartOf':
          // TODO: ?

          break;

        case 'rights':
          $informationObject->accessConditions = $value;

          break;
      }
    }

    return $informationObject;
  }

  public function extract()
  {
    switch ($this->type)
    {
      case 'application/zip':
        $this->directory = $this->filename.'_dir';
        $command = vsprintf('unzip -d %s %s', array($this->directory, $this->filename));
        exec($command, $output, $return);
        if (2 > $return)
        {
          $this->document = @file_get_contents($this->directory.'/METS.xml');
        }
        else
        {
          // throw?
        }

      break;
    }

    $this->document = new SimpleXMLElement($this->document);
  }

  public function process()
  {
    $this->informationObject = new QubitInformationObject;
    $this->informationObject->parentId = $this->resource->id;

    $publicationStatus = sfConfig::get('app_defaultPubStatus', QubitTerm::PUBLICATION_STATUS_DRAFT_ID);
    $this->informationObject->setPublicationStatus($publicationStatus);

    // Main object
    if (null != ($dmdSec = $this->getMainDmdSec()))
    {
      $this->informationObject = $this->processDmdSec($dmdSec, $this->informationObject);
    }

    foreach ($this->getFilesFromDirectory() as $item)
    {
      $parts = pathinfo($item);
      $filename = $parts['basename'];
      $uuid = $this->getUUID($filename);

      $child = new QubitInformationObject;
      $child->setPublicationStatus($publicationStatus);

      if (null !== ($dmdSec = $this->searchFileDmdSec($uuid)))
      {
        $child = $this->processDmdSec($dmdSec, $child);
      }

      $digitalObject = new QubitDigitalObject;
      $digitalObject->assets[] = new QubitAsset($filename, file_get_contents($item));
      $digitalObject->usageId = QubitTerm::MASTER_ID;

      $child->digitalObjects[] = $digitalObject;

      $this->informationObject->informationObjectsRelatedByparentId[] = $child;
    }

    $this->informationObject->save();
}

  public function clean()
  {
    unlink($this->filename);

    $rrmdir = function($directory) use (&$rrmdir)
    {
      $objects = scandir($directory);

      foreach ($objects as $object)
      {
        if ($object != '.' && $object != '..')
        {
          if (filetype($directory.'/'.$object) == 'dir')
          {
            $rrmdir($directory."/".$object);
          }
          else
          {
            unlink($directory."/".$object);
          }
        }
      }

      reset($objects);
      rmdir($directory);
    };

    $rrmdir($this->directory);
  }

  protected function getMainDmdSec()
  {
    $items = $this->document->xpath('//mets/structMap/div/div');

    $id = $items[0]['DMDID'];

    $dmdSec = $this->document->xpath('//mets/dmdSec[@ID="'.$id.'"]');
    if (0 < count($dmdSec))
    {
      return $dmdSec[0];
    }
  }

  protected function searchFileDmdSec($uuid)
  {
    $node = $this->document->xpath('//mets/fileSec/fileGrp[@USE="original"]');

    if (empty($node))
    {
      return;
    }

    foreach ($node[0] as $item)
    {
      if (false !== strstr($item['ID'], $uuid))
      {
        $dmdSec = $this->document->xpath('//mets/dmdSec[@ID="'.$item['DMDID'].'"]');
        if (0 < count($dmdSec))
        {
          return $dmdSec[0];
        }
      }
    }
  }

  protected function getFilesFromDirectory($dir = null)
  {
    $files = array();

    if (!isset($dir))
    {
      $dir = $this->directory.'/objects';
    }

    if ($handle = opendir($dir))
    {
      while (false !== ($file = readdir($handle)))
      {
        if ($file != "." && $file != "..")
        {
          if (is_dir($dir.'/'.$file))
          {
            $dir2 = $dir.'/'.$file;
            $files = $files + $this->getFilesFromDirectory($dir2);
          }
          else
          {
            $files[] = $dir.'/'.$file;
          }
        }
      }

      closedir($handle);
    }

    return $files;
  }

  protected function getUUID($subject)
  {
    preg_match('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $subject, $matches);

    return @$matches[0];
  }
}
