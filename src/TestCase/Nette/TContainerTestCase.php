<?php declare(strict_types = 1);

namespace Ninjify\Nunjuck\TestCase\Nette;

use Nette\DI\Container;

trait TContainerTestCase
{

	/** @var Container */
	protected $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	/**
	 * @return object|null
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
	 */
	protected function getService(string $class)
	{
		return $this->container->getByType($class);
	}

}
