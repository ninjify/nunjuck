<?php declare(strict_types = 1);

use Mockista\Mock;
use Mockista\MockBuilder;
use Mockista\MockInterface;
use Mockista\Registry;

/**
 * *****************************************************************************
 * TESTING TOOLS ***************************************************************
 * *****************************************************************************
 */

if (!function_exists('test')) {

	function test(Closure $function): void
	{
		$function();
	}
}

if (!function_exists('mocki')) {

	/**
	 * @param mixed[] $defaults
	 */
	function mocki(?string $class = null, array $defaults = []): Mock
	{
		$builder = new MockBuilder($class, $defaults);

		return $builder->getMock();
	}
}

if (!function_exists('mockis')) {

	/**
	 * @param mixed[] $methods
	 */
	function mockis(?string $class = null, array $methods = []): MockInterface
	{
		return mockisr()->create($class, $methods);
	}
}

if (!function_exists('mockisr')) {

	function mockisr(): Registry
	{
		return new Registry();
	}
}
