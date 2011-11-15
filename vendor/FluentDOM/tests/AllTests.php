<?php
/**
* Definition file for the unit test suite for FluentDOM
*
* @version $Id: AllTests.php 374 2010-01-18 11:02:58Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*
* @package FluentDOM
* @subpackage unitTests
*/

/**
* Load necessary files
*/
require_once('PHPUnit/Framework.php');
require_once(dirname(__FILE__).'/FluentDOM/AllTests.php');
require_once(dirname(__FILE__).'/FluentDOMTest.php');
if (version_compare(PHP_VERSION, '5.3', '>=')) {
  include_once(dirname(__FILE__).'/FluentDOMTest_PHP5_3.php');
}

PHPUnit_Util_Filter::addFileToFilter(__FILE__);

/**
*
* @package FluentDOM
* @subpackage unitTests
*/
class FluentDOM_AllTests {

  /**
  *
  * @see PHPUnit_Util_Filter::addFileToFilter()
  * @see PHPUnit_Framework_TestSuite::addTestSuite()
  */
  public static function suite() {
    $suite = new PHPUnit_Framework_TestSuite('FluentDOM Package');
    $suite->addTestSuite('FluentDOMTest');
    if (version_compare(PHP_VERSION, '5.3', '>=')) {
      $suite->addTestSuite('FluentDOMTest_PHP5_3');
    }
    $suite->addTestSuite('FluentDOMClasses_AllTests');
    return $suite;
  }
}
?>