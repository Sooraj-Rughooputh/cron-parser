<?php

namespace App;

use Src\Tokeniser\standardFactory as TokeniserFactory;
use Src\Parser\standardFactory as ParserFactory;
use Src\CronFormatter;

class cronExpressionParser
{

    private $tokeniser;
    private $parserFactory;
    private $formatter;

    public function __construct($expression, TokeniserFactory $tokeniserFactory, ParserFactory $parserFactory, CronFormatter $cronFormatter)
    {
        $this->tokeniser = $tokeniserFactory->create($expression);
        $this->parserFactory = $parserFactory;
        $this->formatter = $cronFormatter;

        $this->setUpRanges();
    }

    public function parse()
    {
        $minutesParser = $this->parserFactory->create($this->tokeniser->getMinute(), $this->minuteRange);
        $this->formatter->addLine('minute', $minutesParser->getValues());

        // var_dump([
        // 'getMinute' => $this->tokeniser->getMinute(),
        // 'getValues' => $minutesParser->getValues(),
        // ]); exit;

        $hourParser = $this->parserFactory->create($this->tokeniser->getHour(), $this->hourRange);
        $this->formatter->addLine('hour', $hourParser->getValues());

        $dayOfMonthParser = $this->parserFactory->create($this->tokeniser->getDayOfMonth(), $this->dayOfMonthRange);
        $this->formatter->addLine('day of month', $dayOfMonthParser->getValues());

        $monthParser = $this->parserFactory->create($this->tokeniser->getMonth(), $this->monthRange);
        $this->formatter->addLine('month', $monthParser->getValues());

        $dayOfWeekParser = $this->parserFactory->create($this->tokeniser->getDayOfWeek(), $this->dayOfWeekRange);
        $this->formatter->addLine('day of week', $dayOfWeekParser->getValues());

        $this->formatter->addLine('command', $this->tokeniser->getCommand());

        return $this->formatter->output();
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