![](https://heatbadger.now.sh/github/readme/ninjify/nunjuck/)

<p align=center>
  <a href="https://github.com/ninjify/nunjuck/actions"><img src="https://badgen.net/github/checks/ninjify/nunjuck/master?cache=300"></a>
  <a href="https://coveralls.io/r/ninjify/nunjuck"><img src="https://badgen.net/coveralls/c/github/ninjify/nunjuck?cache=300"></a>
  <a href="https://packagist.org/packages/ninjify/nunjuck"><img src="https://badgen.net/packagist/dm/ninjify/nunjuck"></a>
  <a href="https://packagist.org/packages/ninjify/nunjuck"><img src="https://badgen.net/packagist/v/ninjify/nunjuck"></a>
</p>
<p align=center>
  <a href="https://packagist.org/packages/ninjify/nunjuck"><img src="https://badgen.net/packagist/php/ninjify/nunjuck"></a>
  <a href="https://github.com/ninjify/nunjuck"><img src="https://badgen.net/github/license/ninjify/nunjuck"></a>
  <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
  <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
  <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

## Usage

To install latest version of `ninjify/nunjuck` use [Composer](https://getcomposer.com).

```
composer require --dev ninjify/nunjuck
```

## Versions

| State       | Version      | Branch   | PHP      |
|-------------|--------------|----------|----------|
| dev         | `^0.5.0`     | `master` | `>= 7.1` |
| stable      | `^0.4.0`     | `master` | `>= 7.1` |

## Documentation

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


## Development

See [how to contribute](https://contributte.org) to this package. This package is currently maintained by these authors.

<a href="https://github.com/f3l1x">
    <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
