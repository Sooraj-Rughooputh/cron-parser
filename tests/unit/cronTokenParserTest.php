<?php

use Src\CronTokenParser;

class cronTokenParserTest extends \Codeception\Test\Unit
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
    public function testParserCanBeCreatedWithATokenAndValidRange()
    {
        $token = "1,15";
        $validRange = range(1, 31);

        $parser = new CronTokenParser($token, $validRange);

        $this->assertSame([1,15], $parser->getValues());
    }

    public function testParserCanBeCreatedWithARealTokenAndARealValidRange()
    {
        $token = "*/5";
        $validRange = range(1, 31);
        $expectedResult = [5,10,15,20,25,30];

        $parser = new CronTokenParser($token, $validRange);

        $this->assertSame($expectedResult, $parser->getValues());
    }

}