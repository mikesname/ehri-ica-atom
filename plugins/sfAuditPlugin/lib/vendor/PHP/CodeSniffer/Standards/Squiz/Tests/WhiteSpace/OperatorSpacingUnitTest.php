<?php
/**
 * Unit test class for the OperatorSpacing sniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: OperatorSpacingUnitTest.php,v 1.4 2007/03/12 05:51:49 squiz Exp $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Unit test class for the OperatorSpacing sniff.
 *
 * A sniff unit test checks a .inc file for expected violations of a single
 * coding standard. Expected errors and warnings are stored in this class.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Squiz_Tests_WhiteSpace_OperatorSpacingUnitTest extends AbstractSniffUnitTest
{


    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @return array(int => int)
     */
    public function getErrorList()
    {
        return array(
                4  => 1,
                5  => 1,
                6  => 1,
                7  => 1,
                8  => 1,
                11 => 1,
                12 => 1,
                13 => 1,
                14 => 1,
                15 => 1,
                18 => 1,
                19 => 1,
                20 => 1,
                21 => 1,
                22 => 1,
                25 => 1,
                26 => 1,
                27 => 1,
                28 => 1,
                29 => 1,
                32 => 1,
                33 => 1,
                34 => 1,
                35 => 1,
                36 => 1,
                40 => 1,
                42 => 1,
                44 => 1,
                46 => 1,
                53 => 2,
                54 => 1,
                59 => 5,
                64 => 1,
                77 => 2,
                78 => 1,
                79 => 1,
                80 => 1,
                81 => 1,
                84 => 6,
                85 => 6,
                87 => 4,
                88 => 5,
                90 => 4,
                91 => 5,
               );

    }//end getErrorList()


    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array(int => int)
     */
    public function getWarningList()
    {
        return array();

    }//end getWarningList()


}//end class

?>
