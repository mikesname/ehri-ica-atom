<?php
/**
*
* @version $Id: parent.php 429 2010-03-29 08:05:32Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*/
header('Content-type: text/plain');

$xml = <<<XML
<html>
<head></head>
<body>
  <div>div,
    <span>span, </span>
    <b>b </b>
  </div>
  <p>p,
    <span>span,
      <em>em </em>
    </span>
  </p>
  <div>div,
    <strong>strong,
      <span>span, </span>
      <em>em,
        <b>b, </b>
      </em>
    </strong>
    <b>b </b>
  </div>
</body>
</html>
XML;

require_once('../FluentDOM.php');

echo FluentDOM($xml)
  ->find('//body//*')
  ->each('callback');


function callback($node) {
  $fluentNode = FluentDOM($node);
  $fluentNode->prepend(
    $fluentNode->document->createTextNode(
      $fluentNode->parent()->item(0)->tagName.' > '
    )
  );
}
?>