<?php

namespace Src\Parser;

class standard implements parser
{
    private $tokens = [];
    private $validRange = [];

    private $values = [];

    public function __construct($token, $validRange)
    {
        $this->storeTokens($this->splitToken($token));
        $this->validRange = $validRange;

        $this->parseTokensToValues();
    }

    public function getValues()
    {
        return $this->values;
    }

    private function storeTokens($tokens)
    {
        $patterns = ['/SUN/', '/MON/', '/TUE/', '/WED/', '/THU/', '/FRI/', '/SAT/'];
        $replacements = ['0', '1', '2', '3', '4', '5', '6'];

        foreach ($tokens as $token) {
            $this->tokens[] = preg_replace ($patterns, $replacements, $token);
        }
    }

    private function splitToken($token)
    {
        return explode(",", $token);
    }

    private function parseTokensToValues()
    {
        foreach ($this->tokens ?? [] as $token) {
            $this->values = array_merge($this->values, $this->parseTokenToValues($token));
        }

        sort($this->values, SORT_NUMERIC);
    }

    private function parseTokenToValues($token)
    {
        return array_merge(
          $this->parseLoneWildcardTokenValues($token),
          $this->parseWildcardTokenToValues($token),
          $this->parseRangeTokenToValues($token),
          $this->parseBasicTokenToValues($token)
        );
    }

    private function parseWildcardTokenToValues($token)
    {
        if (!preg_match('/^\*\/(\d+)$/', $token, $matches)) {
            return [];
        }

        $denominator = $matches[1];

        return array_filter(
          $this->validRange,
          function($candidateValue) use ($denominator)
          {
              return ($candidateValue % $denominator) == 0;
          }
        );
    }

    private function parseRangeTokenToValues($token)
    {
        if (!preg_match('/^(\d+)\-(\d+)$/', $token, $matches)) {
            return [];
        }

        $firstInRange = $matches[1];
        $lastInRange = $matches[2];

        return array_filter(
          $this->validRange,
          function($candidateValue) use ($firstInRange, $lastInRange)
          {
              return $candidateValue >= $firstInRange && $candidateValue <= $lastInRange;
          }
        );
    }

    private function parseBasicTokenToValues($token)
    {
        if (!preg_match('/^(\d+)$/', $token, $matches)) {
            return [];
        }

        $basicValue = $matches[1];

        return array_filter(
          $this->validRange,
          function($candidateValue) use ($basicValue)
          {
              return $candidateValue == $basicValue;
          }
        );
    }

    private function parseLoneWildcardTokenValues($token)
    {
        if (!preg_match('/^\*$/', $token, $matches)) {
            return [];
        }

        return $this->validRange;
    }

}