<?php

namespace Src;

class CronFormatter
{
    private $lines = [];

    public function addLine($heading, $data)
    {
        $this->lines[] = $this->renderLine($heading, $data);
    }

    public function output()
    {
        return implode(PHP_EOL, $this->lines);
    }

    private function renderLine($heading, $data)
    {
        return $this->renderHeading($heading) . $this->renderData($data);
    }

    private function renderData($data)
    {
        if (is_array($data)) {
            return implode(' ', $data);
        }

        return $data;
    }

    private function renderHeading($heading)
    {
        return $heading . str_repeat(' ', 14 - strlen($heading));
    }
}