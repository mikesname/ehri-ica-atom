<?php
/**
* Sample how to use the JSON loader
*
* It loads the FluentDOM twitter timeline. This is only an example, Twitter provides XML, too.
*
* @version $Id: jsonToXml.php 414 2010-03-26 17:27:03Z subjective $
* @package FluentDOM
* @subpackage examples
*/

require_once(dirname(__FILE__).'/../../FluentDOM.php');
require_once(dirname(__FILE__).'/../../FluentDOM/Loader/StringJSON.php');

// get the loader object
$jsonLoader = new FluentDOMLoaderStringJSON();
// activate type attributes
$jsonLoader->typeAttributes = TRUE;
// get a FluentDOM
$fd = new FluentDOM();
// inject the loader object
$fd->setLoaders(array($jsonLoader));

$url = 'http://twitter.com/status/user_timeline/FluentDOM.json?count=10';
$json = file_get_contents($url);

header('Content-type: text/xml');
echo $fd->load($json)->formatOutput();

?>