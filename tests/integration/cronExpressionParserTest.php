<?php

use App\CronExpressionParser;

use Src\Tokeniser\standardFactory as TokeniserFactory;
use Src\Parser\standardFactory as ParserFactory;
use Src\CronFormatter;

class cronExpressionParserTests extends \Codeception\Test\Unit
{
    private $tokeniser;
    private $parserFactory;
    private $formatter;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testAppCanBeCreated()
    {
        $app = new CronExpressionParser(null, new TokeniserFactory(), new ParserFactory(), new CronFormatter());
    }

    public function testAppProcessesExampleCronExpressionCorrectly()
    {
        $expression = "*/15 0 1,15 * 1-5 /usr/bin/find";
        $expected = "minute         0 15 30 45
hour           0
day of month   1 15
month          1 2 3 4 5 6 7 8 9 10 11 12
day of week    1 2 3 4 5
command        /usr/bin/find";

        $app = new CronExpressionParser($expression, new TokeniserFactory(), new ParserFactory(), new CronFormatter());

        $this->assertSame($expected, $app->parse());
    }

}
