<?php

namespace Ninjify\Nunjuck;

use Nette\Caching\Storages\FileStorage;
use Nette\Loaders\RobotLoader;
use Tester\Environment as TEnvironment;
use Tester\Helpers as THelpers;

class Environment
{

	const TESTER_DIR = 'TESTER_DIR';
	const APP_DIR = 'APP_DIR';
	const WWW_DIR = 'WWW_DIR';
	const ENGINE_DIR = 'ENGINE_DIR';
	const CASES_DIR = 'CASES_DIR';
	const CASES_UNIT_DIR = 'CASES_UNIT_DIR';
	const CASES_INTEGRATION_DIR = 'CASES_INTEGRATION_DIR';
	const CASES_END_TO_END = 'CASES_END_TO_END';
	const CASES_E2E = 'CASES_E2E';
	const CASES_FRONTEND = 'CASES_FRONTEND';
	const TMP_DIR = 'TMP_DIR';
	const TEMP_DIR = 'TEMP_DIR';
	const CACHE_DIR = 'CACHE_DIR';

	/**
	 * Magic setup method
	 *
	 * @param string $dir
	 * @return void
	 */
	public static function setup($dir)
	{
		self::setupTester();
		self::setupTimezone();
		self::setupVariables($dir);
		self::setupGlobalVariables();
	}

	/**
	 * Configure environment
	 *
	 * @return void
	 */
	public static function setupTester()
	{
		TEnvironment::setup();
	}

	/**
	 * Configure timezone
	 *
	 * @param string $timezone
	 * @return void
	 */
	public static function setupTimezone($timezone = 'Europe/Prague')
	{
		date_default_timezone_set($timezone);
	}

	/**
	 * Configure variables
	 *
	 * @param string $testerDir
	 * @return void
	 */
	public static function setupVariables($testerDir)
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
		define('TEMP_DIR', TMP_DIR . '/tests/' . getmypid() . '-' . lcg_value());
		define('CACHE_DIR', TMP_DIR . '/cache');
		ini_set('session.save_path', TEMP_DIR);

		// Create folders
		self::mkdir(TEMP_DIR);
		self::mkdir(CACHE_DIR);
		self::purge(TEMP_DIR);
	}

	/**
	 * @param string $variable
	 * @param mixed $value
	 * @return void
	 */
	public static function setupVariable($variable, $value)
	{
		define($variable, $value);
	}

	/**
	 * Configure global variables
	 *
	 * @return void
	 */
	public static function setupGlobalVariables()
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
	 *
	 * @param callable $callback
	 * @return void
	 */
	public static function setupRobotLoader(callable $callback = NULL)
	{
		$loader = new RobotLoader();
		$loader->setCacheStorage(new FileStorage(CACHE_DIR));

		if ($callback) {
			$callback($loader);
		} else {
			$loader->addDirectory(ENGINE_DIR);
			$loader->addDirectory(APP_DIR);
			$loader->autoRebuild = TRUE;
		}

		$loader->register();
	}

	/**
	 * @param string $dir
	 * @param int $mask
	 * @param bool $recursive
	 * @return void
	 */
	public static function mkdir($dir, $mask = 0777, $recursive = TRUE)
	{
		if (!is_dir($dir) && @mkdir($dir, $mask, $recursive) === FALSE) {
			if (!is_dir($dir)) {
				die('Cannot create ' . $dir);
			}
		}
	}

	/**
	 * @param string $dir
	 * @return void
	 */
	public static function rmdir($dir)
	{
		if (!is_dir($dir)) return;
		self::purge($dir);
		@rmdir($dir);
	}

	/**
	 * @param string $dir
	 * @return void
	 */
	private static function purge($dir)
	{
		if (!is_dir($dir)) {
			self::mkdir($dir);
		}
		THelpers::purge($dir);
	}

}
