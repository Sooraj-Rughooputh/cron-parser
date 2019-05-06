#!/usr/bin/php
<?php

require_once("vendor/autoload.php");

$config = @include("config.php");

$climate = new League\CLImate\CLImate;

if (!empty($config['arguments'])) {
    $climate->arguments->add($config['arguments']);
    $climate->arguments->parse();
}

$expression = $climate->arguments->get('cron-expression');

echo "CPA: Cron Parser Addresser" . PHP_EOL . PHP_EOL;

if ($climate->arguments->defined('help') || empty($expression)) {
    $climate->usage();
    exit;
}

try {
    $app = new App\cronExpressionParser($expression);

    $climate->to('out')->green($app->parse());
} catch (Throwable $e) {
    $climate->to('error')->red($e->getMessage() . PHP_EOL);
    $climate->usage();
}
echo PHP_EOL;
