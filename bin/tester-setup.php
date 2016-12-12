<?php

use Tester\Dumper;
use Tester\Runner\Output\ConsolePrinter;
use Tester\Runner\Runner;

/** @var Runner $runner */
$runner->outputHandlers = [];
$runner->outputHandlers[] = new class ($runner) extends ConsolePrinter
{

	public function begin()
	{
		ob_start();
		parent::begin();
		echo rtrim(ob_get_clean()) . "\n\n";
	}

	public function result($testName, $result, $message)
	{
		$outputs = [
			Runner::PASSED => Dumper::color('green', '✔ ' . $testName),
			Runner::SKIPPED => Dumper::color('olive', 's ' . $testName) . "($message)",
			Runner::FAILED => Dumper::color('red', '✖ ' . $testName) . "\n" . $this->indent($message, 3) . "\n",
		];
		echo $this->indent($outputs[$result], 2) . PHP_EOL;
	}

	public function end()
	{
		ob_start();
		parent::end();
		echo "\n" . trim(ob_get_clean()) . "\n";
	}

	private function indent($message, $spaces)
	{
		if ($message) {
			$result = '';
			foreach (explode(PHP_EOL, $message) as $line) {
				$result .= str_repeat(' ', $spaces) . $line . PHP_EOL;
			}

			return rtrim($result, PHP_EOL);
		}

		return $message;
	}

};
