<?php

namespace App;

use Src\Tokeniser\standardFactory as TokeniserFactory;
use Src\Parser\standardFactory as ParserFactory;
use Src\CronFormatter;

class cronExpressionParserFactory
{
    public function create($expression) {
        return new CronExpressionParser($expression, new TokeniserFactory(), new ParserFactory(), new CronFormatter());
    }
}
