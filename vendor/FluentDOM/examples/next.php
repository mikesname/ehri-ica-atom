<?php
/**
*
* @version $Id: next.php 322 2009-09-14 20:19:48Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*/
header('Content-type: text/plain');

$xml = <<<XML
<html>
<head></head>
<body>
  <div>
    <button disabled="disabled">First</button> <b>-</b> <span></span></div>
  <div><button>Second</button> - <span></span></div>
  <div><button disabled="disabled">Third</button> - <span></span></div>
</body>
</html>
XML;

require_once('../FluentDOM.php');
echo FluentDOM($xml)
  ->find('//button[@disabled]')
  ->next()
  ->text('This button is disabled.');
?>