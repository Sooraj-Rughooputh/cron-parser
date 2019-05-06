<?php

namespace Src;

class CronTokeniser
{

    private $expression;

    private $tokenCommand;

    public function __construct($expression = null)
    {
        $this->expression = $expression;

        if ($expression) {
            $this->tokeniseExpression();
        }
    }

    public function getCommand()
    {
        return $this->tokenCommand;
    }

    private function tokeniseExpression()
    {
        $tokens = explode(" ", $this->expression);
        if (count($tokens) < 6) {
            throw new Exception("Invalid number of elements in cron expression. Expecting 6 space separated sections.");
        }
        $this->tokenCommand = $tokens[5];
    }
}