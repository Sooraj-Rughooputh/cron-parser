<?php

namespace App;

use Src\CronTokeniser;
use Src\Parser\standardFactory as ParserFactory;
use Src\CronTokenParser;
use Src\CronFormatter;

class cronExpressionParser
{

    private $tokeniser;
    private $parserFactory;

    public function __construct($expression)
    {
        $this->tokeniser = new CronTokeniser($expression);
        $this->parserFactory = new ParserFactory();
        $this->setUpRanges();
    }

    public function parse()
    {
        $formatter = new CronFormatter();

        $minutesParser = $this->parserFactory->create($this->tokeniser->getMinute(), $this->minuteRange);
        $formatter->addLine('minute', $minutesParser->getValues());

        $hourParser = $this->parserFactory->create($this->tokeniser->getHour(), $this->hourRange);
        $formatter->addLine('hour', $hourParser->getValues());

        $dayOfMonthParser = $this->parserFactory->create($this->tokeniser->getDayOfMonth(), $this->dayOfMonthRange);
        $formatter->addLine('day of month', $dayOfMonthParser->getValues());

        $monthParser = $this->parserFactory->create($this->tokeniser->getMonth(), $this->monthRange);
        $formatter->addLine('month', $monthParser->getValues());

        $dayOfWeekParser = $this->parserFactory->create($this->tokeniser->getDayOfWeek(), $this->dayOfWeekRange);
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