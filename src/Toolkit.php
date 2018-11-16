<?php declare(strict_types = 1);

namespace Ninjify\Nunjuck;

use Closure;

class Toolkit
{

	/** @var object|null */
	private static $bind;

	/** @var callable[] */
	private static $setUp = [];

	/** @var callable[] */
	private static $tearDown = [];

	/**
	 * @param object $object
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 */
	public static function bind($object): void
	{
		self::$bind = $object;
	}

	public static function setUp(callable $function): void
	{
		self::$setUp[] = $function;
	}

	public static function tearDown(callable $function): void
	{
		self::$tearDown[] = $function;
	}

	public static function test(callable $function): void
	{
		if (self::$bind !== null) {
			if (!$function instanceof Closure) $function = Closure::fromCallable($function);
			$function = Closure::bind($function, self::$bind, self::$bind);
		}

		foreach (self::$setUp as $cb) {
			$cb();
		}

		$function();

		foreach (self::$tearDown as $cb) {
			$cb();
		}
	}

}
