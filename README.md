# Nunjuck :muscle: (Nette/Tester) [QA] 

Special tuned [nette/tester](https://github.com/nette/tester) for your PHP projects.

-----

[![Build Status](https://img.shields.io/travis/ninjify/nunjuck.svg?style=flat-square)](https://travis-ci.org/ninjify/nunjuck)
[![Code coverage](https://img.shields.io/coveralls/ninjify/nunjuck.svg?style=flat-square)](https://coveralls.io/r/ninjify/nunjuck)
[![Licence](https://img.shields.io/packagist/l/ninjify/nunjuck.svg?style=flat-square)](https://packagist.org/packages/ninjify/nunjuck)
[![Downloads this Month](https://img.shields.io/packagist/dm/ninjify/nunjuck.svg?style=flat-square)](https://packagist.org/packages/ninjify/nunjuck)
[![Downloads total](https://img.shields.io/packagist/dt/ninjify/nunjuck.svg?style=flat-square)](https://packagist.org/packages/ninjify/nunjuck)
[![Latest stable](https://img.shields.io/packagist/v/ninjify/nunjuck.svg?style=flat-square)](https://packagist.org/packages/ninjify/nunjuck)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

## Install

```bash
composer require --dev ninjify/nunjuck
```

## Usage

### Environment

```php
use Ninjify\Nunjuck\Environment;

# Configure Nette\Tester
Environment::setupTester();

# Configure timezone (Europe/Prague by default)
Environment::setupTimezone();

# Configure many constants
Environment::setupVariables();

# Fill global variables
Environment::setupGlobalVariables();

# Register robot loader
Environment::setupRobotLoader();
Environment::setupRobotLoader(function($loader){});
```

### TestCases

There are many predefined test cases.

- `BaseTestCase`
- `BaseMockeryTestCase` + `TMockeryTestCase`
- `BaseMockistaTestCase` + `TMockistaTestCase`
- `BaseContainerTestCase` + `TContainerTestCase`

### Toolkit

`Toolkit` is class for handling anonymous tests functions.

- `Toolkit::setUp(function() { ... })` is called before test function.
- `Toolkit::tearDown(function() { ... })` is after before test function.
- `Toolkit::bind($object)` binds new context into test function, you can access `$this->` inside.
- `Toolkit::test(function() { ... })` triggers test function.

### Notes

Little helper to your tests.

```php
use Ninjify\Nunjuck\Notes;

Notes::add('My note');

# ['My note']
$notes = Notes::fetch(); 

Notes::clear();
```

---------------

Thanks for testing, reporting and contributing.
