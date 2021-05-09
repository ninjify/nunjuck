<?php declare(strict_types = 1);

namespace Ninjify\Nunjuck;

use Nette\Loaders\RobotLoader;
use RuntimeException;
use Tester\Environment as TEnvironment;
use Tester\Helpers as THelpers;

class Environment
{

	public const TESTER_DIR = 'TESTER_DIR';
	public const APP_DIR = 'APP_DIR';
	public const WWW_DIR = 'WWW_DIR';
	public const ENGINE_DIR = 'ENGINE_DIR';
	public const CASES_DIR = 'CASES_DIR';
	public const CASES_UNIT_DIR = 'CASES_UNIT_DIR';
	public const CASES_INTEGRATION_DIR = 'CASES_INTEGRATION_DIR';
	public const CASES_END_TO_END = 'CASES_END_TO_END';
	public const CASES_E2E = 'CASES_E2E';
	public const CASES_FRONTEND = 'CASES_FRONTEND';
	public const TMP_DIR = 'TMP_DIR';
	public const TEMP_DIR = 'TEMP_DIR';
	public const CACHE_DIR = 'CACHE_DIR';

	/**
	 * Magic setup method
	 */
	public static function setup(string $dir): void
	{
		self::setupTester();
		self::setupTimezone();
		self::setupVariables($dir);
		self::setupGlobalVariables();
	}

	/**
	 * Configure environment
	 */
	public static function setupTester(): void
	{
		TEnvironment::setup();
	}

	/**
	 * Configure timezone
	 */
	public static function setupTimezone(string $timezone = 'Europe/Prague'): void
	{
		date_default_timezone_set($timezone);
	}

	/**
	 * Configure variables
	 */
	public static function setupVariables(string $testerDir): void
	{
		if (!is_dir($testerDir)) {
			die(sprintf('Provide existing folder, "%s" does not exist.', $testerDir));
		}

		// Base tester directory
		define('TESTER_DIR', realpath($testerDir));

		// Application directories
		define('APP_DIR', realpath(TESTER_DIR . '/../app'));
		define('WWW_DIR', realpath(TESTER_DIR . '/../www'));

		// Tester directories
		define('ENGINE_DIR', TESTER_DIR . '/engine');
		define('CASES_DIR', TESTER_DIR . '/cases');
		define('CASES_UNIT_DIR', TESTER_DIR . '/cases/unit');
		define('CASES_INTEGRATION_IDR', TESTER_DIR . '/cases/integration');

		// Temp, cache directories
		define('TMP_DIR', TESTER_DIR . '/tmp');
		define('TEMP_DIR', TMP_DIR . '/tests/' . getmypid() . '/' . md5(uniqid((string) microtime(true), true) . lcg_value() . mt_rand(0, 20) . microtime()));
		define('CACHE_DIR', TMP_DIR . '/cache');
		ini_set('session.save_path', TEMP_DIR);

		// Create folders
		clearstatcache(true, TMP_DIR);
		self::mkdir(TMP_DIR);
		clearstatcache(true, CACHE_DIR);
		self::mkdir(CACHE_DIR);
		clearstatcache(true, TEMP_DIR);
		self::mkdir(TEMP_DIR);
		clearstatcache(true, TEMP_DIR);
		self::purge(TEMP_DIR);
	}

	/**
	 * @param mixed $value
	 */
	public static function setupVariable(string $variable, $value): void
	{
		define($variable, $value);
	}

	/**
	 * Configure global variables
	 */
	public static function setupGlobalVariables(): void
	{
		$_SERVER = array_intersect_key($_SERVER, array_flip([
			'PHP_SELF',
			'SCRIPT_NAME',
			'SERVER_ADDR',
			'SERVER_SOFTWARE',
			'HTTP_HOST',
			'DOCUMENT_ROOT',
			'OS',
			'argc',
			'argv',
		]));
		$_SERVER['REQUEST_TIME'] = 1234567890;
		$_ENV = $_GET = $_POST = [];
	}

	/**
	 * Configure robot loader
	 */
	public static function setupRobotLoader(?callable $callback = null): void
	{
		$loader = new RobotLoader();
		$loader->setTempDirectory(CACHE_DIR);

		if ($callback !== null) {
			$callback($loader);
		} else {
			$loader->addDirectory(ENGINE_DIR);
			$loader->addDirectory(APP_DIR);
			$loader->setAutoRefresh(true);
		}

		$loader->register();
	}

	public static function mkdir(string $dir, int $mode = 0777, bool $recursive = true): void
	{
		if (is_dir($dir) === false && @mkdir($dir, $mode, $recursive) === false) {
			clearstatcache(true, $dir);
			$error = error_get_last();

			if (is_dir($dir) === false && !file_exists($dir) === false) {
				throw new RuntimeException(sprintf("Unable to create directory '%s'. " . $error['message'], $dir));
			}
		}
	}

	public static function rmdir(string $dir): void
	{
		if (!is_dir($dir)) {
			return;
		}

		self::purge($dir);
		@rmdir($dir);
	}

	private static function purge(string $dir): void
	{
		if (!is_dir($dir)) {
			self::mkdir($dir);
		}

		THelpers::purge($dir);
	}

}
