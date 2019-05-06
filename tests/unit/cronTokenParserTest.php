<?php

use Src\Parser\factory;
use Src\Parser\standardFactory;

class cronTokenParserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $factory;

    public function __construct()
    {
        $this->factory = new standardFactory();

        return parent::__construct();
    }

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

        $parser = $this->factory->create($token, $validRange);

        $this->assertSame([1,15], $parser->getValues());
    }

    public function testParserCanBeCreatedWithARealTokenAndARealValidRange()
    {
        $token = "*/5";
        $validRange = range(1, 31);
        $expectedResult = [5,10,15,20,25,30];

        $parser = $this->factory->create($token, $validRange);

        $this->assertSame($expectedResult, $parser->getValues());
    }

    public function testParserRecognisesACommaSeparatedListOfDifferentTypesOfValues()
    {
        $token = "*/12,3-9,37,52,56-58";
        $validRange = range(0, 59);
        $expectedResult = [0,3,4,5,6,7,8,9,12,24,36,37,48,52,56,57,58];

        $parser = $this->factory->create($token, $validRange);

        $this->assertSame($expectedResult, $parser->getValues());
    }

    public function testParserCanParseAsteriskExpression()
    {
        $token = "*";
        $validRange = range(1, 7);
        $expectedResult = [1,2,3,4,5,6,7];

        $parser = $this->factory->create($token, $validRange);

        $this->assertSame($expectedResult, $parser->getValues());
    }

    public function testParserUnderstandsWeekdays()
    {
        $token = "MON,WED-FRI";
        $validRange = range(0, 6);
        $expectedResult = [1,3,4,5];

        $parser = $this->factory->create($token, $validRange);

        $this->assertSame($expectedResult, $parser->getValues());
    }

}