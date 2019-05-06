<?php

namespace App;

use Src\CronTokeniser;
use Src\CronTokenParser;
use Src\CronFormatter;

class cronExpressionParser
{
    private $tokeniser;

    public function __construct($expression)
    {
        $this->tokeniser = new CronTokeniser($expression);
        $this->setUpRanges();
    }

    public function parse()
    {
        $formatter = new CronFormatter();

        $minutesParser = new CronTokenParser($this->tokeniser->getMinute(), $this->minuteRange);
        $formatter->addLine('minute', $minutesParser->getValues());

        $hourParser = new CronTokenParser($this->tokeniser->getHour(), $this->hourRange);
        $formatter->addLine('hour', $hourParser->getValues());

        $dayOfMonthParser = new CronTokenParser($this->tokeniser->getDayOfMonth(), $this->dayOfMonthRange);
        $formatter->addLine('day of month', $dayOfMonthParser->getValues());

        $monthParser = new CronTokenParser($this->tokeniser->getMonth(), $this->monthRange);
        $formatter->addLine('month', $monthParser->getValues());

        $dayOfWeekParser = new CronTokenParser($this->tokeniser->getDayOfWeek(), $this->dayOfWeekRange);
        $formatter->addLine('day of week', $dayOfWeekParser->getValues());

        $formatter->addLine('command', $this->tokeniser->getCommand());

        return $formatter->output();
    }

    public function setUpRanges()
    {
        $this->minuteRange = range(0, 59);
        $this->hourRange = range(0, 23);
        $this->dayOfMonthRange = range(0, 31);
        $this->monthRange = range(1, 12);
        $this->dayOfWeekRange = range(0,6);
    }
}