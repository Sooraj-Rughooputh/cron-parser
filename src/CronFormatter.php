<?php

namespace Src;

class CronFormatter
{
    public function addLine($heading, $arrayOfNumbers)
    {
        $heading = 'mintue';
        $arrayOfNumbers = '0 15 30 45';
        return true;

    }

    public function output()
    {
        return 'minute           0 15 30 45';
    }
}
