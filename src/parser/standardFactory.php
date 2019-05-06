<?php

namespace Src\Parser;

class standardFactory implements factory
{
    public function create($token, $validRange)
    {
        return new standard($token, $validRange);
    }
}
