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
        $expectedOutput = $heading . str_repeat(' ', 15 - strlen($heading)) . '0 15 30 45';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $output = $formatter->output();

        $this->assertSame($expectedOutput, $output);

    }

    public function testFormatterOutputsLinesBuiltFromArrayOfNumbers()
    {
        $arrayOfNumbers = [0, 3, 6, 9, 12, 15, 18, 21];
        $heading = 'hour';
        $expectedOutput = $heading . str_repeat(' ', 15 - strlen($heading)) . '0 3 6 9 12 15 18 21';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $output = $formatter->output();

        $this->assertSame($expectedOutput, $output);
    }

    public function testFormatterOutputsMultipleLines()
    {
        $arrayOfNumbers = [0, 15, 30, 45];
        $heading = 'minute';
        $expectedOutput = $heading . str_repeat(' ', 15 - strlen($heading)) . '0 15 30 45';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $arrayOfNumbers = [0, 3, 6, 9, 12, 15, 18, 21];
        $heading = 'hour';
        $expectedOutput .= PHP_EOL . $heading . str_repeat(' ', 15 - strlen($heading)) . '0 3 6 9 12 15 18 21';

        $formatter->addLine($heading, $arrayOfNumbers);

        $this->assertSame($expectedOutput, $formatter->output());
    }

    public function testFormatterHandlesLineContainingCommand()
    {
        $command = '/usr/bin/find';
        $heading = 'command';
        $expectedOutput = $heading . str_repeat(' ', 15 - strlen($heading)) . '/usr/bin/find';

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $command);

        $this->assertSame($expectedOutput, $formatter->output());
    }

    public function testFormatterResetsForReuseAfterOutput()
    {
        $arrayOfNumbers = [0, 15, 30, 45];
        $heading = 'minute';
        $headingWidth = 15;

        $formatter = new CronFormatter();

        $formatter->addLine($heading, $arrayOfNumbers);

        $formatter->output();

        $command = '/usr/bin/find';
        $heading = 'command';
        $expectedOutput = $heading . str_repeat(' ', $headingWidth - strlen($heading)) . '/usr/bin/find';

        $formatter->addLine($heading, $command);

        $this->assertSame($expectedOutput, $formatter->output());
    }

}
