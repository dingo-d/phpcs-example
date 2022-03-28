<?php

namespace MyCoolStandards\PhpCSExample\Tests\Strings;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * @covers \MyCoolStandard\PhpCSExample\Sniffs\Strings\DisallowHelloWorldSniff
 */
class DisallowHelloWorldUnitTest extends AbstractSniffUnitTest
{
	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array <int line number> => <int number of errors>
	 */
	public function getErrorList(): array
	{
		return [];
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array <int line number> => <int number of warnings>
	 */
	public function getWarningList(): array
	{
		return [
			3 => 1,
			5 => 1,
			6 => 1,
			10 => 1,
			11 => 1,
		];
	}
}