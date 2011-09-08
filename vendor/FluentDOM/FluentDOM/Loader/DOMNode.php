<?php
/**
* Load FluentDOM from DOMNode
*
* @version $Id: DOMNode.php 431 2010-03-29 20:42:04Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*
* @package FluentDOM
* @subpackage Loaders
*/

/**
* include interface
*/
require_once(dirname(__FILE__).'/../Loader.php');

/**
* Load FluentDOM from DOMDocument
*
* @package FluentDOM
* @subpackage Loaders
*/
class FluentDOMLoaderDOMNode implements FluentDOMLoader {

  /**
  * attach existing DOMNode->ownerdocument and select the DOMNode
  *
  * @param DOMNode $source
  * @param string $contentType
  * @return array(DOMDocument,DOMNode)|FALSE
  */
  public function load($source, $contentType) {
    if ($source instanceof DOMNode && !empty($source->ownerDocument)) {
      return array($source->ownerDocument, array($source));
    }
    return FALSE;
  }
}

?>