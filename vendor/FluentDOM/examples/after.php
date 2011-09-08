<?php
/**
*
* @version $Id: after.php 322 2009-09-14 20:19:48Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*/
header('Content-type: text/plain');

$xml = <<<XML
<html>
<head></head>
<body>
  <p>I would like to say: </p>
</body>
</html>
XML;

require_once('../FluentDOM.php');
echo FluentDOM($xml)
  ->find('//p')
  ->after('<b>Hello</b>')
  ->after(' World');
?>