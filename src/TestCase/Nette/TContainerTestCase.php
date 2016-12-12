<?php

namespace Ninjify\Tester\TestCase\Nette;

use Nette\DI\Container;

trait TContainerTestCase
{

	/** @var Container */
	protected $container;

	/**
	 * @param Container $container
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	/**
	 * CONTAINER ***************************************************************
	 */

	/**
	 * @param string $class
	 * @return object
	 */
	protected function getService($class)
	{
		return $this->container->getByType($class);
	}

}
