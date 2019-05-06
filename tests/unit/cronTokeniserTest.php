<?php

use Src\Tokeniser\standard as CronTokeniser;

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

    // tests
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


    public function testTokeniseCronExpressionReturnsAllTokenisedItems()
    {
        $minuteExpression = uniqid();
        $hourExpression = uniqid();
        $dayOfMonthExpression = uniqid();
        $monthExpression = uniqid();
        $dayOfWeekExpression = uniqid();
        $commandExpression = uniqid();
        $expression = implode(" ", [$minuteExpression, $hourExpression, $dayOfMonthExpression, $monthExpression, $dayOfWeekExpression, $commandExpression]);

        $tokeniser = new CronTokeniser($expression);

        $command = $tokeniser->getCommand();
        $this->assertSame($minuteExpression , $tokeniser->getMinute());
        $this->assertSame($hourExpression , $tokeniser->getHour());
        $this->assertSame($dayOfMonthExpression , $tokeniser->getDayOfMonth());
        $this->assertSame($monthExpression , $tokeniser->getMonth());
        $this->assertSame($dayOfWeekExpression , $tokeniser->getDayOfWeek());
        $this->assertSame($commandExpression , $tokeniser->getCommand());
    }

    public function testTokeniserThrowsExceptionWhenGivenInvalidNumberOfArgumentsInExpression()
    {
        $expression = "1 2 3 4 /usr/bin/find";

        $this->expectException(\Exception::class);
        $tokeniser = new CronTokeniser($expression);
    }

}
