<?php
/**
* FluentDOM::closest() Usage example
*
* Be aware that you check the current context node.
* The expression 'li' whould search for a node containing a <li> child node.
* The example uses the self:: axis to avoid this.
*
* @version $Id: closest.php 336 2009-09-28 11:32:35Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*/
header('Content-type: text/plain');

$xml = <<<XML
<html>
<head></head>
<body>
  <ul class="myList">
    <li class="red"><b>The <i>first <u>item</u></i></b>.</li>
    <li class="green"><b>The <i>second <u>item</u></i></b>.</li>
    <li class="yellow"><b>The <i>third <u>item</u></i></b>.</li>
    <li class="blue"><b>The <i>fourth <u>item</u></i></b>.</li>
  </ul>
  <p>Class of the last clicked item: <span id="display"> </span>
  </p>
</body>
</html>
XML;

require_once('../FluentDOM.php');
$dom = FluentDOM($xml);
echo $dom
  ->find('//u')
  ->closest('self::li')
  ->addClass('foundIt');

?>