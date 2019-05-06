#!/usr/local/bin/php
<?php

require_once("vendor/autoload.php");

$config = @include("config.php");

$climate = new League\CLImate\CLImate;

if (!empty($config['arguments'])) {
    $climate->arguments->add($config['arguments']);
    $climate->arguments->parse();
}

$expression = $climate->arguments->get('cron-expression');

$climate->out("CPA: Cron Parser Addresser" . PHP_EOL);

if ($climate->arguments->defined('help') || empty($expression)) {
    $climate->usage();
    exit;
}

try {
    $app = (new App\cronExpressionParserFactory())->create($expression);

    $climate->to('out')->green($app->parse());
} catch (Throwable $e) {
    $climate->to('error')->red($e->getMessage() . PHP_EOL);
    $climate->usage();
}

$climate->out(PHP_EOL);
