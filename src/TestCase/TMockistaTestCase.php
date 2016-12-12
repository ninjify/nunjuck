<?php

namespace Ninjify\Tester\TestCase;

use Mockista\Registry;

trait TMockistaTestCase
{

	/** @var Registry */
	protected $mockista;

	/**
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();
		$this->mockista = new Registry();
	}

	/**
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */
	protected function tearDown()
	{
		parent::tearDown();
		$this->mockista->assertExpectations();
	}

}
