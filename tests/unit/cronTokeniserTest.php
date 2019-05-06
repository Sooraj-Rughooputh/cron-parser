<?php

use Src\CronTokeniser;

class cronTokeniserTest extends \Codeception\Test\Unit
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

    public function testClassCanBeCreated()
    {
        $tokeniser = new CronTokeniser();
    }

    public function testTokeniseCronExpression()
    {
        $expression = "*/15 0 1,15 * 1-5 /usr/bin/find";
        $tokeniser = new CronTokeniser($expression);

        $command = $tokeniser->getCommand();
        $this->assertSame('/usr/bin/find', $command);
    }

    public function testTokeniseCronExpressionReturnsRealCommand()
    {
        $expression = "*/15 0 1,15 * 1-5 /usr/bin/bash";
        $tokeniser = new CronTokeniser($expression);

        $command = $tokeniser->getCommand();
        $this->assertSame('/usr/bin/bash', $command);

    }

    public function testTokeniseCronExpressionReturnsTokenisedExpression()
    {
        $commandExpression = uniqid();
        $expression = "*/15 0 1,15 * 1-5 " . $commandExpression;
        $tokeniser = new CronTokeniser($expression);

        $command = $tokeniser->getCommand();
        $this->assertSame($commandExpression , $command);
    }

    public function testTokeniserThrowsExceptionWhenGivenInvalidNumberOfArgumentsInExpression()
    {
        $expression = "1 2 3 4 /usr/bin/find";

        $this->expectException(\Exception::class);
        $tokeniser = new CronTokeniser($expression);
    }
}
