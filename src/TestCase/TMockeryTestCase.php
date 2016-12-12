<?php

namespace Ninjify\Nunjuck\TestCase;

use Mockery;
use Mockery\Container;

trait TMockeryTestCase
{

	/** @var Container */
	protected $mockery;

	/**
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();
		$this->mockery = Mockery::getContainer();
	}

	/**
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */
	protected function tearDown()
	{
		parent::tearDown();
		$this->mockery->mockery_verify();
	}

}
