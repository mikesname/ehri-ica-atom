<?php
/**
*
* @version $Id: children.php 322 2009-09-14 20:19:48Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*/
header('Content-type: text/plain');

$xml = <<<XML
<html>
<head></head>
<body>
  <div id="container">
    <p>This <span>is the <em>way</em> we</span>
    write <em>the</em> demo,</p>
  </div>
</body>
</html>
XML;

require_once('../FluentDOM.php');
echo FluentDOM($xml)
  ->find('//div[@id = "container"]/p')
  ->children()
  ->toggleClass('child');

echo "\n\n";

echo FluentDOM($xml)
  ->find('//div[@id = "container"]/p')
  ->children('name() = "em"')
  ->toggleClass('child');
?>