<?php

namespace Src\Parser;

interface parser
{
    public function __construct($token, $validRange);
    public function getValues();
}
