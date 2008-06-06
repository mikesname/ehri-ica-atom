<?php

/**
 * Symfony_Sniffs_Files_LineEndingsSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Jack Bates <ms419@freezone.co.uk>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: LineEndingsSniff.php 62 2007-09-17 22:39:11Z jablko $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 * @link      http://trac.symfony-project.com/trac/wiki/CodingStandards
 */

if (class_exists('Generic_Sniffs_Files_LineEndingsSniff', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class Generic_Sniffs_Files_LineEndingsSniff not found');
}

/**
 * Symfony_Sniffs_Files_LineEndingsSniff.
 *
 * Checks that end of line characters are "\n".
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Jack Bates <ms419@freezone.co.uk>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 * @link      http://trac.symfony-project.com/trac/wiki/CodingStandards
 */
class Symfony_Sniffs_Files_LineEndingsSniff extends Generic_Sniffs_Files_LineEndingsSniff
{
    /**
     * The valid EOL character.
     *
     * @var string
     */
    protected $eolChar = "\n";
}
