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
}
