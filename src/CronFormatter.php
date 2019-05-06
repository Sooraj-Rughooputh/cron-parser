<?php

namespace Src;

class CronFormatter
{
    const HEADING_COLUMN_WIDTH = 15;

    private $lines = [];

    public function addLine($heading, $data)
    {
        $this->lines[] = $this->renderLine($heading, $data);
    }

    public function output()
    {
        $output = implode(PHP_EOL, $this->lines);

        $this->reset();

        return $output;
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
        return $heading . str_repeat(' ', static::HEADING_COLUMN_WIDTH - strlen($heading));
    }

    private function reset()
    {
        $this->lines = [];
    }
}
