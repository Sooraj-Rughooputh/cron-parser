<?php

use Src\CronTokeniser;

class cronTokeniserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testClassCanBeCreated()
    {
        $tokeniser = new CronTokeniser();
    }
}
