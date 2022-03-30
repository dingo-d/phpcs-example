# Example repo for building custom PHPCS sniffs

The idea is to go step by step through the repo and see how you can build up your custom sniff.

## Chapters (organized by branches)

1. Project setup - installing the phpcs using Composer
2. Set up the sniffs folder and ruleset
3. Add the basis of our sniff - showcase using `register` and `process` methods
4. Add some tests and util packages like `PhpCSDebug`.
   1. Note - you can use composer scripts to check your code and run tests
   2. Note - using `composer standards:check -- --standard=PhpCSDebug ./PhpCSExample/Tests/Strings/DisallowHelloWorldUnitTest.inc` will list all the tokens in the test file - this helps a lot when writing sniffs, just to get your bearings
5. Update your sniff to catch some basic examples in tests
6. Add the first edge case and a way to solve it (only the `echo 'hello', ' world';` part, the other edge case will fail, that's intentional!)
7. Add the fix for the edge case
8. Add documentation for your custom sniff
   1. You can check the documentation using `vendor/bin/phpcs --standard=PhpCSExample --generator=Text`
9. Add a failing edge case - string concatenation - this one you can figure out how to cover in the sniff :)

## Tips and tricks

You can use [different reports](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Reporting) when running phpcs:

```bash
vendor/bin/phpcs PhpCSExample/Tests/Strings/DisallowHelloWorldUnitTest.inc --standard=PhpCSExample --report=code
```

You can run the phpcs in [interactive mode](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Usage), and fix things on the fly:

```bash
vendor/bin/phpcs PhpCSExample/Tests/Strings/DisallowHelloWorldUnitTest.inc --standard=PhpCSExample -a
```

You can use filters (useful if you use git hooks):

```bash
vendor/bin/phpcs PhpCSExample/Tests/Strings/DisallowHelloWorldUnitTest.inc --standard=PhpCSExample --filter=GitModified
vendor/bin/phpcs PhpCSExample/Tests/Strings/DisallowHelloWorldUnitTest.inc --standard=PhpCSExample --filter=GitStaged
```

You can ignore annotations (`// phpcs:ignore` comments) with `--ignore-annotations`

## Useful links

### Php_CodeSniffer

https://github.com/squizlabs/PHP_CodeSniffer/

### External rulesets on Packagist

https://packagist.org/?query=phpcs&type=phpcodesniffer-standard
https://packagist.org/?query=php_codesniffer&type=phpcodesniffer-standard

### Dealerdirect Composer plugin for PHPCS

https://github.com/PHPCSStandards/composer-installer

### Useful tools for sniff development

https://github.com/PHPCSStandards/PHPCSUtils
https://github.com/PHPCSStandards/PHPCSDevTools
