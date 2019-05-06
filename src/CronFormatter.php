<?php

namespace Src;

class CronFormatter
{
    private $lines = [];

    public function addLine($heading, $numbers)
    {
        $this->lines[] = $this->renderLine($heading, $numbers);
    }

    public function output()
    {
        return implode(PHP_EOL, $this->lines);
    }

    private function renderLine($heading, $numbers)
    {
        $line = $heading;
        $line .= str_repeat(' ', 14 - strlen($heading));
        $line .= implode(' ', $numbers);

        return $line;
    }
}