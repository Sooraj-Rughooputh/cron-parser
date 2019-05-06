<?php

namespace Src;

class CronTokeniser
{

    private $expression;

    private $tokenMinute;
    private $tokenHour;
    private $tokenDayOfMonth;
    private $tokenMonth;
    private $tokenDayOfWeek;
    private $tokenCommand;

    public function __construct($expression = null)
    {
        $this->expression = $expression;

        if ($expression) {
            $this->tokeniseExpression();
        }
    }

    private function tokeniseExpression()
    {
        $tokens = explode(" ", $this->expression);
        if (count($tokens) < 6) {
            throw new Exception("Invalid number of elements in cron expression. Expecting 6 space separated sections.");
        }
        $this->tokenMinute = $tokens[0];
        $this->tokenHour = $tokens[1];
        $this->tokenDayOfMonth = $tokens[2];
        $this->tokenMonth = $tokens[3];
        $this->tokenDayOfWeek = $tokens[4];
        $this->tokenCommand = $tokens[5];
    }

    public function getMinute()
    {
        return $this->tokenMinute;
    }

    public function getHour()
    {
        return $this->tokenHour;
    }

    public function getDayOfMonth()
    {
        return $this->tokenDayOfMonth;
    }

    public function getMonth()
    {
        return $this->tokenMonth;
    }

    public function getDayOfWeek()
    {
        return $this->tokenDayOfWeek;
    }

    public function getCommand()
    {
        return $this->tokenCommand;
    }
}