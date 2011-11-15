<?php
/**
*
* @version $Id: siblings.php 322 2009-09-14 20:19:48Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*/
header('Content-type: text/plain');

$xml = <<<XML
<html>
<head></head>
<body>
  <ul>
    <li>One</li>
    <li>Two</li>
    <li class="hilite">Three</li>
    <li>Four</li>
  </ul>
  <ul>
    <li>Five</li>
    <li>Six</li>
    <li>Seven</li>
  </ul>
  <ul>
    <li>Eight</li>
    <li class="hilite">Nine</li>
    <li>Ten</li>
    <li class="hilite">Eleven</li>
  </ul>
  <p>Unique siblings: <b></b></p>
</body>
</html>
XML;

require_once('../FluentDOM.php');
echo FluentDOM($xml)
  ->find('//li[@class = "hilite"]')
  ->siblings()
  ->addClass('before');
?>