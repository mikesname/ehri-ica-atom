<?php
/**
 * Squiz_Sniffs_Objects_ObjectInstantiationSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: ObjectMemberCommaSniff.php,v 1.1 2008/02/15 04:22:27 squiz Exp $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Squiz_Sniffs_Objects_ObjectInstantiationSniff.
 *
 * Ensures objects are assigned to a variable when instantiated.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Squiz_Sniffs_Objects_ObjectMemberCommaSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array('JS');


    /**
     * Registers the token types that this sniff wishes to listen to.
     *
     * @return array
     */
    public function register()
    {
        return array(T_CLOSE_CURLY_BRACKET);

    }//end register()


    /**
     * Process the tokens that this sniff is listening for.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Only interested in orphaned braces, which are objects.
        if (isset($tokens[$stackPtr]['scope_condition']) === true) {
            return;
        }

        $prev = $phpcsFile->findPrevious(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if ($tokens[$prev]['code'] === T_COMMA) {
            $error = 'Last member of object must not be followed by a comma';
            $phpcsFile->addError($error, $prev);
        }

    }//end process()


}//end class

?>