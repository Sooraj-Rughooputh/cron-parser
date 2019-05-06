<?php

namespace Src\Tokeniser;

class standardFactory implements factory
{
    public function create($expression)
    {
        return new standard($expression);
    }
}
