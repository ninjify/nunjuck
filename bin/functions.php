<?php

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
	/**
	 * @param Closure $function
	 * @return void
	 */
	function test(Closure $function)
	{
		$function();
	}
}

if (!function_exists('mocki')) {
	/**
	 * @param string $class
	 * @param array $defaults
	 * @return Mock
	 */
	function mocki($class = NULL, array $defaults = [])
	{
		$builder = new MockBuilder($class, $defaults);

		return $builder->getMock();
	}
}

if (!function_exists('mockis')) {
	/**
	 * @param string $class
	 * @param array $methods
	 * @return MockInterface
	 */
	function mockis($class = NULL, array $methods = [])
	{
		return (mockisr()->create($class, $methods));
	}
}

if (!function_exists('mockisr')) {
	/**
	 * @return Registry
	 */
	function mockisr()
	{
		return new Registry();
	}
}
