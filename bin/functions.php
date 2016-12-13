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

/**
 * @param Closure $function
 * @return void
 */
function test(Closure $function)
{
	$function();
}

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

/**
 * @param string $class
 * @param array $methods
 * @return MockInterface
 */
function mockis($class = NULL, array $methods = [])
{
	return (mockisr()->create($class, $methods));
}

/**
 * @return Registry
 */
function mockisr()
{
	return new Registry();
}
