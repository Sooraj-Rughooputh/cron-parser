<?php

use App\CronExpressionParser;

class cronExpressionParserTests extends \Codeception\Test\Unit
{
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
        $app = new CronExpressionParser();
    }

    public function testAppProcessesExampleCronExpressionCorrectly()
    {
        $expression = "*/15 0 1,15 * 1-5 /usr/bin/find";
        $expected = "minute        0 15 30 45
hour          0
day of month  1 15
month         1 2 3 4 5 6 7 8 9 10 11 12
day of week   1 2 3 4 5
command       /usr/bin/find";

        $app = new CronExpressionParser($expression);

        $this->assertSame($expected, $app->parse());
    }

}