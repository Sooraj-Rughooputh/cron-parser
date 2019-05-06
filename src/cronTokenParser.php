<?php

namespace Src;

class CronTokenParser
{
    private $tokens = [];
    private $validRange = [];

    private $values = [];

    public function __construct($token, $validRange)
    {
        $this->tokens = $this->splitToken($token);
        $this->validRange = $validRange;

        $this->parseTokensToValues();
    }

    public function getValues()
    {
        return $this->values;
    }

    private function splitToken($token)
    {
        return explode(",", $token);
    }

    private function parseTokensToValues()
    {
        foreach ($this->tokens ?? [] as $token) {
            $this->values += $this->parseTokenToValues($token);
        }
    }

    private function parseTokenToValues($token)
    {
        return
          $this->parseWildcardTokenToValues($token)
          +
          $this->parseRangeTokenToValues($token)
          +
          $this->parseBasicTokenToValues($token)
          ;
    }

}