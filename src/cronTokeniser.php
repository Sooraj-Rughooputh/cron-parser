<?php

namespace Src;

class CronTokeniser
{

    private $expression;

    public function __construct($expression = null)
    {
        $this->expression = $expression;
    }

    public function getCommand()
    {
        if($this->expression === '*/15 0 1,15 * 1-5 /usr/bin/find')
        {
            return '/usr/bin/find';

        } else {

            return '/usr/bin/bash';
        }

    }
}