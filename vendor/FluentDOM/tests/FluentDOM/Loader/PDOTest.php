<?php
/**
* DOMDocument loader test for FluentDOMLoaderPDO
*
* @version $Id: PDOTest.php 430 2010-03-29 15:53:43Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*
* @package FluentDOM
* @subpackage UnitTests
*/

/**
* load necessary files
*/
require_once('PHPUnit/Framework.php');
require_once(dirname(__FILE__).'/../../../FluentDOM/Loader/PDO.php');

PHPUnit_Util_Filter::addFileToFilter(__FILE__);

/**
* Test class for FluentDOMLoaderPDO.
*
* @package FluentDOM
* @subpackage UnitTests
*/
class FluentDOMLoaderPDOTest extends PHPUnit_Framework_TestCase {

  public function testLoad() {
    if (!extension_loaded('pdo')) {
  	  $this->markTestSkipped('PDO extension not loaded');
  	}
  	if (!in_array('sqlite', PDO::getAvailableDrivers())) {
  	  $this->markTestSkipped('PDO SQLite driver not loaded');
  	}
    $loader = new FluentDOMLoaderPDO();
    $database = new PDO('sqlite:'.dirname(__FILE__).'/data/FluentDOMLoaderPDO.sqlite');
    $statement = $database->query('SELECT * FROM sample');
    $result = $loader->load($statement, 'text/xml');
    $this->assertTrue($result instanceof DOMDocument);
    $this->assertXmlStringEqualsXmlFile(
      dirname(__FILE__).'/data/FluentDOMLoaderPDO.xml',
      $result->saveXML()
    );
  }

  public function testLoadInvalid() {
    $loader = new FluentDOMLoaderPDO();
    $result = $loader->load(NULL, 'text/xml');
    $this->assertFalse($result);
  }

  public function testSetTagNames() {
    $loader = new FluentDOMLoaderPDO();
    $loader->setTagNames('samples', 'sample');
    $this->assertSame('samples', $this->readAttribute($loader, '_tagNameRoot'));
    $this->assertSame('sample', $this->readAttribute($loader, '_tagNameRecord'));
  }
}

?>