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

    public function testFormatterOutputsMinuteLine()
    {
        $arrayOfNumbers = [0, 15, 30, 45];
        $heading = 'minute';
        $expectedOutput = $heading . str_repeat(' ', 14 - strlen($heading)) . '0 15 30 45';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $output = $formatter->output();

        $this->assertSame($expectedOutput, $output);

    }

    public function testFormatterOutputsLinesBuiltFromArrayOfNumbers()
    {
        $arrayOfNumbers = [0, 3, 6, 9, 12, 15, 18, 21];
        $heading = 'hour';
        $expectedOutput = $heading . str_repeat(' ', 14 - strlen($heading)) . '0 3 6 9 12 15 18 21';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $output = $formatter->output();

        $this->assertSame($expectedOutput, $output);
    }

    public function testFormatterOutputsMultipleLines()
    {
        $arrayOfNumbers = [0, 15, 30, 45];
        $heading = 'minute';
        $expectedOutput = $heading . str_repeat(' ', 14 - strlen($heading)) . '0 15 30 45';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $this->assertSame($expectedOutput, $formatter->output());

        $arrayOfNumbers = [0, 3, 6, 9, 12, 15, 18, 21];
        $heading = 'hour';
        $expectedOutput .= PHP_EOL . $heading . str_repeat(' ', 14 - strlen($heading)) . '0 3 6 9 12 15 18 21';

        $formatter->addLine($heading, $arrayOfNumbers);

        $this->assertSame($expectedOutput, $formatter->output());
    }

}