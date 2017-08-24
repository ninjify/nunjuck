<?php

namespace Tests;

/**
 * Test: Toolkit
 */

use Ninjify\Nunjuck\Notes;
use Ninjify\Nunjuck\Toolkit;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

class BindClass
{

	/**
	 * @return void
	 */
	public function call1()
	{
		Notes::add('CALL1');
	}

	/**
	 * @return void
	 */
	protected function call2()
	{
		Notes::add('CALL2');
	}

}

Toolkit::setUp(function () {
	Notes::add('SETUP1');
});

Toolkit::setUp(function () {
	Notes::add('SETUP2');
});

Toolkit::tearDown(function () {
	Notes::add('DOWN1');
});

Toolkit::tearDown(function () {
	Notes::add('DOWN2');
});

Toolkit::bind(new BindClass());

Toolkit::test(function () {
	$this->call1();
	Notes::add('INNER');
	$this->call2();
});

Assert::equal([
	'SETUP1',
	'SETUP2',
	'CALL1',
	'INNER',
	'CALL2',
	'DOWN1',
	'DOWN2',
], Notes::fetch());
