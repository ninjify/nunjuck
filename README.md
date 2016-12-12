# Nunjuck :muscle: (Nette/Tester) [QA] 

Special tuned [nette/tester](https://github.com/nette/tester) for your PHP projects.

-----

[![Build Status](https://img.shields.io/travis/ninjify/nunjuck.svg?style=flat-square)](https://travis-ci.org/ninjify/nunjuck)
[![Downloads total](https://img.shields.io/packagist/dt/ninjify/nunjuck.svg?style=flat-square)](https://packagist.org/packages/ninjify/nunjuck)
[![Latest stable](https://img.shields.io/packagist/v/ninjify/nunjuck.svg?style=flat-square)](https://packagist.org/packages/ninjify/nunjuck)
[![Licence](https://img.shields.io/packagist/l/ninjify/nunjuck.svg?style=flat-square)](https://packagist.org/packages/ninjify/nunjuck)

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
