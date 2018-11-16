<?php declare(strict_types = 1);

namespace Ninjify\Nunjuck\TestCase;

use Mockista\Registry;

trait TMockistaTestCase
{

	/** @var Registry */
	protected $mockista;

	/**
	 * This method is called before a test is executed.
	 */
	protected function setUp(): void
	{
		parent::setUp();
		$this->mockista = new Registry();
	}

	/**
	 * This method is called after a test is executed.
	 */
	protected function tearDown(): void
	{
		parent::tearDown();
		$this->mockista->assertExpectations();
	}

}
