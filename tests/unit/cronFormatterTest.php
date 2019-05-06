<?php

use Src\CronFormatter;

class cronFormatterTest extends \Codeception\Test\Unit
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
    public function testFormatterCanBeCreated()
    {
        $formatter = new CronFormatter();
    }

    public function testFormatterOutputsLinesBuiltFromArrayOfNumbers()
    {
        $arrayOfNumbers = [0, 15, 30, 45];
        $heading = 'minute';
        $expectedOutput = $heading . str_repeat(' ', 17 - strlen($heading)) . '0 15 30 45';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $output = $formatter->output();

        $this->assertSame($expectedOutput, $output);

    }
}
