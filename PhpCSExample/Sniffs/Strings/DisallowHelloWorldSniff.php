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

		// echo is a construct that will output one or more expressions with no additional newlines or spaces.
		// Check if the next token is a comma, and if the previous non whitespace token is an echo.
		$previousPtr = $phpcsFile->findPrevious(\T_WHITESPACE, $stackPtr - 1, null, true, null, true);

		if ($tokens[$stackPtr + 1]['code'] === \T_COMMA && $tokens[$previousPtr]['code'] === \T_ECHO) {
			$nextString = $phpcsFile->findnext(\T_CONSTANT_ENCAPSED_STRING, $stackPtr + 1, null, false, null, true);
			$nextContent = \strtolower($tokens[$nextString]['content']);

			if (strpos($content, 'hello') !== false && preg_match('/\s+world/', $nextContent) !== 0) {
				$phpcsFile->addWarning(
					'Hello World found. How very dare you?!',
					$stackPtr,
					'helloWorldUsageDetected'
				);
				return;
			}
		}

		// Check for a string containing a hello world in it. No matter how many spaces there are between the two words.
		if (preg_match('/hello\s+world/', $content) !== 0) {
			$phpcsFile->addWarning(
				'Hello World found. How very dare you?!',
				$stackPtr,
				'helloWorldUsageDetected'
			);
			return;
		}
	}
}
