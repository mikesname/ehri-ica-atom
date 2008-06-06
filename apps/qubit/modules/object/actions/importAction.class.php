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

class ObjectImportAction extends sfAction
{
  // ingest an uploaded file and import it as an object w/relations
  public function execute($request)
  {
    // should we do strict validation? (recommended)
    $this->strictXMLParsing = false;

    // load the uploaded file into a DOMXML object (assuming it's XML as per the file import validator)
    $importDOM = $this->loadXML($this->getRequest()->getFilePath('file'));

    // if we were unable to parse the XML file at all
    if (empty($importDOM->documentElement))
    {
      $this->errors = $this->getContext()->getI18N()->__('unable to parse XML file: malformed or unresolvable entities');
      return sfView::ERROR;
    }

    // if libxml threw errors, populate them to show in the template
    if ($importDOM->libxmlerrors)
    {
      // warning condition, XML file has errors (perhaps not well-formed or invalid?)
      foreach ($importDOM->libxmlerrors as $libxmlerror)
      {
        $xmlerrors[] = $this->getContext()->getI18N()->__('libxml error %code% on line %line% in input file: %message%', array('%code%' => $libxmlerror->code, '%message%' => $libxmlerror->message, '%line%' => $libxmlerror->line));
      }
      $this->errors = $xmlerrors;
    }

    // FIXME: hardcoded until we decide how these will be developed
    $validSchemas = array(
        // document type declarations
        '+//ISBN 1-931666-00-8//DTD ead.dtd (Encoded Archival Description (EAD) Version 2002)//EN' => 'ead',
        '+//ISBN 1-931666-00-8//DTD ead.dtd Encoded Archival Description (EAD) Version 2002//EN' => 'ead',
        '-//Society of American Archivists//DTD ead.dtd (Encoded Archival Description (EAD) Version 1.0)//EN' => 'ead1',
        // namespaces
        'http://www.loc.gov/METS/' => 'mets',
        'http://www.loc.gov/mods/' => 'mods',
        'http://www.loc.gov/MARC21/slim' => 'marc',
        // root element names
        'collection' => 'marc',
        'record' => 'marc',
        'mods' => 'mods',
        'ead' => 'ead',
        'add' => 'alouette');

    // determine what kind of schema we're trying to import
    $schemaDescriptors = array($importDOM->documentElement->tagName);
    if (!empty($importDOM->namespaces))
    {
      krsort($importDOM->namespaces);
      $schemaDescriptors = array_merge($schemaDescriptors, $importDOM->namespaces);
    }
    if (!empty($importDOM->doctype))
    {
      $schemaDescriptors = array_merge($schemaDescriptors, array($importDOM->doctype->name, $importDOM->doctype->systemId, $importDOM->doctype->publicId));
    }

    foreach ($schemaDescriptors as $descriptor)
    {
      if (array_key_exists($descriptor, $validSchemas))
      {
        $importSchema = $validSchemas[$descriptor];
      }
    }

    $importMap = sfConfig::get('sf_app_lib_dir').DIRECTORY_SEPARATOR.'import'.DIRECTORY_SEPARATOR.$importSchema.'.yml';
    if (!file_exists($importMap))
    {
      // error condition, unknown schema or no import filter
      $this->errors = $this->getContext()->getI18N()->__('unknown schema or import format: "%format%"', array('%format%' => $importSchema));
      return sfView::ERROR;
    }

    $this->schemaMap = sfYaml::load($importMap);

    // create the base object(s) we're importing from the schema mapping
    $this->BaseObject = eval("return new Qubit".$this->schemaMap['BaseObject'].";");

    // if XSLs are specified in the mapping, process them
    if (!empty($this->schemaMap['processXSLT']))
    {
      // pre-filter through XSLs in order
      foreach ((array) $this->schemaMap['processXSLT'] as $importXSL)
      {
        $importXSL = sfConfig::get('sf_app_lib_dir').DIRECTORY_SEPARATOR.'xslt'.DIRECTORY_SEPARATOR.$importXSL;

        if (file_exists($importXSL))
        {
          // instantiate an XSLT parser
          $xslDOM = new DOMDocument;
          $xslDOM->load($importXSL);

          // Configure the transformer
          $xsltProc = new XSLTProcessor;
          $xsltProc->registerPHPFunctions();
          $xsltProc->importStyleSheet($xslDOM);

          $importDOM->loadXML($xsltProc->transformToXML($importDOM));
        }
      }

      // re-initialize xpath on the new XML
      $importDOM->xpath = new DOMXPath($importDOM);
    }

    // remove config parameters from the schema map
    $this->objectType = $this->schemaMap['BaseObject'];
    unset($this->schemaMap['BaseObject']);
    unset($this->schemaMap['processXSLT']);

    // go through schema map and populate objects/properties
    foreach ($this->schemaMap as $mapping)
    {
      $nodeList = $importDOM->xpath->query($mapping['XPath']);

      foreach ($nodeList as $domNode)
      {
        // set the object to invoke methods on
        if (empty($mapping['Object']))
        {
          $mapping['Object'] = 'BaseObject';
        }

        // normalize the node text (trim whitespace manually); NB: this will strip any child elements, eg. HTML tags
        $nodeValue = trim(preg_replace('/[\n\r\s]+/', ' ', $domNode->nodeValue));

        // if you want the full XML from the node, use this
        $nodeXML = $domNode->ownerDocument->saveXML($domNode);

        // set the parameters for the method call
        if (empty($mapping['Parameters']))
        {
          $parameters = $nodeValue;
        }
        else
        {
          $parameters = array();
          foreach ($mapping['Parameters'] as $parameter)
          {
            eval("\$parameters[] = ".$parameter.";");
          }
        }

        // ensure the object is of a valid type
        if (!class_exists($mapping['Object']))
        {
          // warning condition, import mapping has called a non-existent object/class
          continue;
        }

        // create a new object if we're trying to access one that doesn't exist
        if (!eval("return isset(\$this->".$mapping['Object'].");"))
        {
          eval("\$this->".$mapping['Object']." = new Qubit".$mapping['Object'].";");
        }

        // ensure the method exists on the object/class
        if (!eval("return method_exists(\$this->".$mapping['Object'].", '".$mapping['Method']."');"))
        {
          // warning condition, import mapping has called a non-existent method
          continue;
        }

        // invoke the object and method defined in the schema map
        $result = eval("return call_user_func_array(array(&\$this->\$mapping['Object'], \$mapping['Method']), \$parameters);");

        // save the context object after every modification to ensure referential integrity
        eval("\$this->".$mapping['Object']."->save();");
      }
    }
    return sfView::SUCCESS;
  }

  /*
   * modified helper methods from (http://www.php.net/manual/en/ref.dom.php):
   *
   * - create a DOMDocument from a file
   * - parse the namespaces in it
   * - create a XPath object with all the namespaces registered
   *  - load the schema locations
   *  - validate the file on the main schema (the one without prefix)
   */
  private function loadXML($file)
  {
      libxml_use_internal_errors(true);

      // FIXME: trap possible load validation errors (just suppress for now)
      $err_level = error_reporting(0);

      $doc = new DOMDocument;

      if ($this->strictXMLParsing)
      {
        $doc->validateOnParse = true;
        $doc->resolveExternals = true;
      }
      $doc->preserveWhitespace = false;
      $doc->errors = false;
      $doc->load($file);

      $xsi = false;
      $doc->namespaces = array();
      $doc->xpath = new DOMXPath($doc);

      // pass along any XML errors that have been generated
      $doc->libxmlerrors = libxml_get_errors();

      // if the document didn't parse correctly, stop right here
      if (empty($doc->documentElement))
      {
        return $doc;
      }

      $attr = $this->getnodeAttributes($doc->documentElement);

      error_reporting($err_level);

      foreach ($attr as $name => $value)
      {
          if (substr($name,0,5) == "xmlns")
          {
              $uri = $value;
              $pre = $doc->documentElement->lookupPrefix($uri);
              if ($uri == "http://www.w3.org/2001/XMLSchema-instance")
                  $xsi = $pre;
              $doc->namespaces[$pre] = $uri;
              if ($pre == "")
                  $pre = "noname";
              $doc->xpath->registerNamespace($pre, $uri);
          }
      }

      if (!isset($doc->namespaces[""]))
      {
      $doc->namespaces[""] = $doc->documentElement->namespaceURI;
      }

      if ($xsi)
      {
          $doc->schemaLocations = array();
          $lst = $doc->xpath->query("//@$xsi:schemaLocation");
          foreach ($lst as $el)
          {
              $re = "{[\\s\n\r]*([^\\s\n\r]+)[\\s\n\r]*([^\\s\n\r]+)}";
              preg_match_all($re, $el->nodeValue, $mat);
              for ($i=0; $i<count($mat[0]); $i++)
              {
                  $value = $mat[2][$i];
                  $doc->schemaLocations[ $mat[1][$i] ] = $value;
              }
          }

      // validate document against default namespace schema
      $doc->schemaValidate($doc->schemaLocations[$doc->namespaces[""]]);
      }

      return $doc;
  }

  private function getnodeAttributes($node)
  {
      $mat = $this->decodeNode($node);
      $txt = $mat[2];
      $re = "{((?:\\w*:)?\\w+)[\\s\n\r]*=[\\s\n\r]*(\"[^\"]*\"|\'[^\']*\')}";
      preg_match_all($re, $txt, $mat);
      $att = array();
      for ($i=0; $i<count($mat[0]); $i++)
      {
          $value = $mat[2][$i];
          if ($value[0] == "\'" || $value[0] == "\"")
          {
              $len = strlen($value);
              $value = substr($value, 1, strlen($value)-2);
          }
          $att[ $mat[1][$i] ] = $value;
      }
      return $att;
  }

  private function decodeNode($node)
  {
      $out = $node->ownerDocument->saveXML($node);
      $re = "{^<((?:\\w*:)?\\w*)"."[\\s\n\r]*((?:[\\s\n\r]*"."(?:\\w*:)?\\w+[\\s\n\r]*=[\\s\n\r]*"."(?:\"[^\"]*\"|\'[^\']*\'))*)"."[\\s\n\r]*>[\r\n]*"."((?:.*[\r\n]*)*)"."[\r\n]*</\\1>$}";
      preg_match($re, $out, $mat);
      return $mat;
  }
}

?>
