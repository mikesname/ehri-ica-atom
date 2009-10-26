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
 * Import an XML document into Qubit.
 *
 * @package    Qubit
 * @subpackage library
 * @author     MJ Suhonos
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */
class QubitXmlImport
{
  protected
    $errors = null,
    $rootObject = null;

  /**
   * Execute import
   *
   * @param string $xmlStr xml document
   * @param array $options optional parameters
   * @return QubitXmlImport this object
   */
  public function __construct()
  {
    //
  }

  public static function execute($xmlStream, $options = array())
  {
    $qubitXmlImport = new QubitXmlImport;

    // load the XML document into a DOMXML object
    $importDOM = self::loadXML($xmlStream, $options = array('strictXmlParsing' => false));

    // if we were unable to parse the XML file at all
    if (empty($importDOM->documentElement))
    {
      $errorMsg = sfContext::getInstance()->getI18N()->__('unable to parse XML file: malformed or unresolvable entities');

      throw new Exception($errorMsg);
    }

    // if libxml threw errors, populate them to show in the template
    if ($importDOM->libxmlerrors)
    {
      // warning condition, XML file has errors (perhaps not well-formed or invalid?)
      foreach ($importDOM->libxmlerrors as $libxmlerror)
      {
        $xmlerrors[] = sfContext::getInstance()->getI18N()->__('libxml error %code% on line %line% in input file: %message%', array('%code%' => $libxmlerror->code, '%message%' => $libxmlerror->message, '%line%' => $libxmlerror->line));
      }

      $qubitXmlImport->errors = array_merge((array) $qubitXmlImport->errors, $xmlerrors);
    }

    // FIXME: hardcoded until we decide how these will be developed
    $validSchemas = array(
      // document type declarations
      '+//ISBN 1-931666-00-8//DTD ead.dtd Encoded Archival Description (EAD) Version 2002//EN' => 'ead',
      '-//Society of American Archivists//DTD ead.dtd (Encoded Archival Description (EAD) Version 1.0)//EN' => 'ead1',
      // namespaces
      'http://www.loc.gov/METS/' => 'mets',
      'http://www.loc.gov/mods/' => 'mods',
      'http://www.loc.gov/MARC21/slim' => 'marc',
      // root element names
      //'collection' => 'marc',
      //'record' => 'marc',
      'record' => 'oai_dc_record',
      'dc' => 'dc',
      'dublinCore' => 'dc',
      'metadata' => 'dc',
      //'mets' => 'mets',
      //'mods' => 'mods',
      'ead' => 'ead',
      'add' => 'alouette'
    );

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

    // just validate EAD import for now until we can get StrictXMLParsing working for all schemas in the self::LoadXML function. Having problems right now loading schemas.
    if ('ead' == $importSchema)
    {
      $importDOM->validate();
      // if libxml threw errors, populate them to show in the template
      foreach (libxml_get_errors() as $libxmlerror)
      {
        $qubitXmlImport->errors[] = sfContext::getInstance()->getI18N()->__('libxml error %code% on line %line% in input file: %message%', array('%code%' => $libxmlerror->code, '%message%' => $libxmlerror->message, '%line%' => $libxmlerror->line));
      }
    }

    $importMap = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR.'object'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'import'.DIRECTORY_SEPARATOR.$importSchema.'.yml';
    if (!file_exists($importMap))
    {
      // error condition, unknown schema or no import filter
      $errorMsg = sfContext::getInstance()->getI18N()->__('unknown schema or import format: "%format%"', array('%format%' => $importSchema));

      throw new Exception($errorMsg);
    }

    $qubitXmlImport->schemaMap = sfYaml::load($importMap);

    // if XSLs are specified in the mapping, process them
    if (!empty($qubitXmlImport->schemaMap['processXSLT']))
    {
      // pre-filter through XSLs in order
      foreach ((array) $qubitXmlImport->schemaMap['processXSLT'] as $importXSL)
      {
        $importXSL = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'xslt'.DIRECTORY_SEPARATOR.$importXSL;

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
          unset($xslDOM);
          unset($xsltProc);
        }
        else
        {
          $qubitXmlImport->errors[] = sfContext::getInstance()->getI18N()->__('unable to load import XSL filter: "%importXSL%"', array('%importXSL%' => $importXSL));
        }
      }

      // re-initialize xpath on the new XML
      $importDOM->xpath = new DOMXPath($importDOM);
    }

    // switch source culture if langusage is set in an EAD document
    if ($importSchema == 'ead')
    sfLoader::loadHelpers(array('I18N'));
    {
      if (is_object($langusage = $importDOM->xpath->query('//eadheader/profiledesc/langusage/language/@langcode')))
      {
        $sf_user = sfContext::getInstance()->getUser();
        $currentCulture = $sf_user->getCulture();
        $langCodeConvertor = new fbISO639_Map;
        foreach ($langusage as $language)
        {
          $isocode = trim(preg_replace('/[\n\r\s]+/', ' ', $language->nodeValue));
          // convert to Symfony culture code
          if (!$twoCharCode = strtolower($langCodeConvertor->getID2($isocode)))
          {
            $twoCharCode = $isocode;
          }
          // Check to make sure that the selected language is supported with a Symfony i18n data file.
          // If not it will cause a fatal error in the Language List component on every response.
          try
          {
            format_language($twoCharCode, $twoCharCode);
          }
          catch (Exception $e)
          {
            $qubitXmlImport->errors[] = __('EAD "langmaterial" is set to').': "'.$isocode.'". '.__('This language is currently not supported.');
            continue;
          }

          if ($currentCulture !== $twoCharCode)
          {
            $qubitXmlImport->errors[] = __('EAD "langmaterial" is set to').': "'.$isocode.'" ('.format_language($twoCharCode, 'en').'). '.__('Your XML document has been saved in this language and your user interface has just been switched to this language.');
          }
          $sf_user->setCulture($twoCharCode);
          // can only set to one language, so have to break once the first valid language is encountered
          break;
        }
      }
    }

    unset($qubitXmlImport->schemaMap['processXSLT']);

    // go through schema map and populate objects/properties
    foreach ($qubitXmlImport->schemaMap as $name => $mapping)
    {

      // if object is not defined or a valid class, we can't process this mapping
      if (empty($mapping['Object']) || !class_exists('Qubit'.$mapping['Object']))
      {
        $qubitXmlImport->errors[] = sfContext::getInstance()->getI18N()->__('non-existent class defined in import mapping: "%class%"', array('%class%' => 'Qubit'.$mapping['Object']));
        continue;
      }

      // get a list of XML nodes to process
      $nodeList = $importDOM->xpath->query($mapping['XPath']);

      foreach ($nodeList as $domNode)
      {
        // create a new object
        $class = 'Qubit'.$mapping['Object'];
        $currentObject = new $class;

        // set the rootObject to use for initial display in successful import
        if (!$qubitXmlImport->rootObject)
        {
          $qubitXmlImport->rootObject = $currentObject;
        }

        // if a parent path is specified, try to parent the node
        if (empty($mapping['Parent']))
        {
          $parentNodes = new DOMNodeList;
        }
        else
        {
          $parentNodes = $importDOM->xpath->query('('.$mapping['Parent'].')', $domNode);
        }

        if ($parentNodes->length > 0)
        {
          // parent ID comes from last node in the list because XPath forces forward document order
          $parentId = $parentNodes->item($parentNodes->length - 1)->getAttribute('xml:id');
          unset($parentNodes);

          if (!empty($parentId) && is_callable(array($currentObject, 'setParentId')))
          {
            $currentObject->setParentId($parentId);
          }
        }
        else
        {
          // orphaned object, set root if possible
          if (is_callable(array($currentObject, 'setRoot')))
          {
            $currentObject->setRoot();
          }
        }

        // go through methods and populate properties
        foreach ($mapping['Methods'] as $name => $methodMap)
        {

          // if method is not defined, we can't process this mapping
          if (empty($methodMap['Method']) || !is_callable(array($currentObject, $methodMap['Method'])))
          {
            $qubitXmlImport->errors[] = sfContext::getInstance()->getI18N()->__('non-existent method defined in import mapping: "%method%"', array('%method%' => $methodMap['Method']));
            continue;
          }

          // get a list of XML nodes to process
          $nodeList2 = $importDOM->xpath->query($methodMap['XPath'], $domNode);

          if (is_object($nodeList2))
          {

            switch($name)
            {
              // hack: some multi-value elements (e.g. 'languages') need to get passed as one array instead of individual nodes values
              case 'languages':
                $langCodeConvertor = new fbISO639_Map;
                $value = array();
                foreach ($nodeList2 as $nodeee)
                {
                  if ($twoCharCode = $langCodeConvertor->getID2($nodeee->nodeValue))
                  {
                    $value[] = strtolower($twoCharCode);
                  }
                  else
                  {
                    $value[] = $nodeee->nodeValue;
                  }
                }
                $currentObject->language = $value;
                break;
              default:
                foreach ($nodeList2 as $domNode2)
                {
                  // normalize the node text (trim whitespace manually); NB: this will strip any child elements, eg. HTML tags
                  $nodeValue = trim(preg_replace('/[\n\r\s]+/', ' ', $domNode2->nodeValue));

                  // if you want the full XML from the node, use this
                  $nodeXML = $domNode2->ownerDocument->saveXML($domNode2);
                  // set the parameters for the method call
                  if (empty($methodMap['Parameters']))
                  {
                    $parameters = array($nodeValue);
                  }
                  else
                  {
                    $parameters = array();
                    foreach ((array) $methodMap['Parameters'] as $parameter)
                    {
                      // if the parameter begins with %, evaluate it as an XPath expression relative to the current node
                      if ('%' == substr($parameter, 0, 1))
                      {
                        // evaluate the XPath expression
                        $xPath = substr($parameter, 1);
                        $result = $importDOM->xpath->query($xPath, $domNode2);

                        if ($result->length > 1)
                        {
                          // convert nodelist into an array
                          foreach ($result as $element)
                          {
                            $resultArray[] = $element->nodeValue;
                          }
                          $parameters[] = $resultArray;
                        }
                        else
                        {
                          // pass the node value unaltered; this provides an alternative to $nodeValue above
                          $parameters[] = $result->item(0)->nodeValue;
                        }
                      }
                      else
                      {
                        // NB: this will throw warnings when DOM is accessed directly from mapping and returns null objects
                        eval('$parameters[] = '.$parameter.';');
                      }
                    }
                  }

                  // invoke the object and method defined in the schema map
                  call_user_func_array(array( & $currentObject, $methodMap['Method']), $parameters);
                }
            }

            unset($nodeList2);
          }
        }

        // save the object after it's fully-populated
        $currentObject->save();

        // write the ID onto the current XML node for tracking
        $domNode->setAttribute('xml:id', $currentObject->getId());
      }
    }

    return $qubitXmlImport;
  }

  /**
   * modified helper methods from (http://www.php.net/manual/en/ref.dom.php):
   *
   * - create a DOMDocument from a file
   * - parse the namespaces in it
   * - create a XPath object with all the namespaces registered
   *  - load the schema locations
   *  - validate the file on the main schema (the one without prefix)
   *
   * @param string $xmlStream XML document bitstream
   * @param array $options optional parameters
   * @return DOMDocument an object representation of the XML document
   */
  protected static function loadXML($xmlStream, $options = array())
  {
    libxml_use_internal_errors(true);

    // FIXME: trap possible load validation errors (just suppress for now)
    $err_level = error_reporting(0);
    $doc = new DOMDocument('1.0', 'UTF-8');

    // Default $strictXmlParsing to TRUE
    $strictXmlParsing = (isset($options['strictXmlParsing'])) ? $options['strictXmlParsing'] : true;

    if ($strictXmlParsing)
    {
      // enforce all XML parsing rules and validation
      $doc->validateOnParse = true;
      $doc->resolveExternals = true;
    }
    else
    {
      // try to load whatever we've got, even if it's malformed or invalid
      $doc->recover = true;
      $doc->strictErrorChecking = false;
    }
    $doc->formatOutput = false;
    $doc->preserveWhitespace = false;

    $doc->loadXML($xmlStream);

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

    error_reporting($err_level);

    // look through the entire document for namespaces
    $re = '/xmlns:([^=]+)="([^"]+)"/';
    preg_match_all($re, $xmlStream, $mat, PREG_SET_ORDER);

    foreach ($mat as $xmlns)
    {
      $pre = $xmlns[1];
      $uri = $xmlns[2];

      $doc->namespaces[$pre] = $uri;

      if ($pre == '')
      {
        $pre = 'noname';
      }
      $doc->xpath->registerNamespace($pre, $uri);
    }

    if (!isset($doc->namespaces['']))
    {
      $doc->namespaces[''] = $doc->documentElement->lookupnamespaceURI(null);
    }

    if ($xsi)
    {
      $doc->schemaLocations = array();
      $lst = $doc->xpath->query('//@$xsi:schemaLocation');
      foreach ($lst as $el)
      {
        $re = "{[\\s\n\r]*([^\\s\n\r]+)[\\s\n\r]*([^\\s\n\r]+)}";
        preg_match_all($re, $el->nodeValue, $mat);
        for ($i = 0; $i < count($mat[0]); $i++)
        {
          $value = $mat[2][$i];
          $doc->schemaLocations[$mat[1][$i]] = $value;
        }
      }

      // validate document against default namespace schema
      $doc->schemaValidate($doc->schemaLocations[$doc->namespaces['']]);
    }

    return $doc;
  }

  /**
   * Return true if import had errors
   *
   * @return boolean
   */
  public function hasErrors()
  {
    return $this->errors != null;
  }

  /**
   * Return array of error messages
   *
   * @return unknown
   */
  public function getErrors()
  {
    return $this->errors;
  }

  /**
   * Get the root object for the import
   *
   * @return mixed the root object (object type depends on import type)
   */
  public function getRootObject()
  {
    return $this->rootObject;
  }
}
