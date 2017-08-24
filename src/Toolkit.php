<?php

namespace Ninjify\Nunjuck;

use Closure;

class Toolkit
{

	/** @var mixed */
	private static $bind;

	/** @var callable[] */
	private static $setUp = [];

	/** @var callable[] */
	private static $tearDown = [];

	/**
	 * @param mixed $object
	 * @return void
	 */
	public static function bind($object)
	{
		self::$bind = $object;
	}

	/**
	 * @param callable $function
	 * @return void
	 */
	public static function setUp(callable $function)
	{
		self::$setUp[] = $function;
	}

	/**
	 * @param callable $function
	 * @return void
	 */
	public static function tearDown(callable $function)
	{
		self::$tearDown[] = $function;
	}

	/**
	 * @param callable $function
	 * @return void
	 */
	public static function test(callable $function)
	{
		if (self::$bind) {
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
