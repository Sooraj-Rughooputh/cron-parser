<?php

namespace Src\Tokeniser;

interface tokeniser
{
    public function __construct($expression);

    public function getMinute();
    public function getHour();
    public function getDayOfMonth();
    public function getMonth();
    public function getDayOfWeek();
    public function getCommand();

}
