<?php

namespace MyCoolStandard\PhpCSExample\Sniffs\Strings;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class DisallowHelloWorldSniff implements Sniff
{
	/**
	 * Registers the tokens that this sniff wants to listen for.
	 *
	 * An example return value for a sniff that wants to listen for whitespace
	 * and any comments would be:
	 *
	 * <code>
	 *    return array(
	 *            T_WHITESPACE,
	 *            T_DOC_COMMENT,
	 *            T_COMMENT,
	 *           );
	 * </code>
	 *
	 * @return int[]
	 * @see    Tokens.php
	 */
	public function register()
	{
		return [
			\T_CONSTANT_ENCAPSED_STRING
		];
	}

	/**
	 * Called when one of the token types that this sniff is listening for
	 * is found.
	 *
	 * The stackPtr variable indicates where in the stack the token was found.
	 * A sniff can acquire information this token, along with all the other
	 * tokens within the stack by first acquiring the token stack:
	 *
	 * <code>
	 *    $tokens = $phpcsFile->getTokens();
	 *    echo 'Encountered a '.$tokens[$stackPtr]['type'].' token';
	 *    echo 'token information: ';
	 *    print_r($tokens[$stackPtr]);
	 * </code>
	 *
	 * If the sniff discovers an anomaly in the code, they can raise an error
	 * by calling addError() on the \PHP_CodeSniffer\Files\File object, specifying an error
	 * message and the position of the offending token:
	 *
	 * <code>
	 *    $phpcsFile->addError('Encountered an error', $stackPtr);
	 * </code>
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
	 *                                               token was found.
	 * @param int $stackPtr The position in the PHP_CodeSniffer
	 *                                               file's token stack where the token
	 *                                               was found.
	 *
	 * @return void Optionally returns a stack pointer. The sniff will not be
	 *                  called again on the current file until the returned stack
	 *                  pointer is reached. Return (count($tokens) + 1) to skip
	 *                  the rest of the file.
	 */
	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		$content = \strtolower($tokens[$stackPtr]['content']);
		
		// Check for a string containing a hello world in it.
		if (strpos($content, 'hello world') !== false) {
			$phpcsFile->addWarning(
				'Hello World found. How very dare you?!',
				$stackPtr,
				'helloWorldUsageDetected'
			);
		}

	}
}
