<?php

use Ninjify\Tester\OutputHandler\BetterConsolePrinter;
use Tester\Runner\Runner;

/** @var Runner $runner */
$runner->outputHandlers = [];
$runner->outputHandlers[] = new BetterConsolePrinter($runner);
