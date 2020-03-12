<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\GetCurrencyRateFromHttpBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\ICurrencyRateHttpResource;
use CurrencyRate\CurrencyRateNull;
use CurrencyRate\CurrencyRate;

class GetCurrencyRateFromHttpBehaviourTest extends \PHPUnit\Framework\TestCase
{
    private $behavior;
    private $behaviorNull;
    private $mockResource;
    private $mockResourceNull;

    protected function setUp():void
    {
        $this->mockResource = $this->getMockBuilder(ICurrencyRateHttpResource::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockResourceNull = $this->getMockBuilder(ICurrencyRateHttpResource::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->behaviorNull = new GetCurrencyRateFromHttpBehaviour(new GetCurrencyRateNullBehaviour(), $this->mockResourceNull);
        $this->behavior = new GetCurrencyRateFromHttpBehaviour(new GetCurrencyRateNullBehaviour(), $this->mockResource);

    }

    public function testGetForEmpty()
    {
        $this->mockResourceNull->expects($this->any())
            ->method('get')
            ->with('USD', 'RUR')
            ->willReturn(new CurrencyRateNull());
        $this->assertInstanceOf(CurrencyRateNull::class, $this->behaviorNull->get('USD', 'RUR'));
    }

    public function testGetForExists()
    {
        $this->mockResource->expects($this->any())
            ->method('get')
            ->with('USD', 'RUR')
            ->willReturn(new CurrencyRate(80, 'USD', 'RUR'));

        $this->assertEquals("1 USD is 80.00 RUR", $this->behavior->get('USD', 'RUR')->message());
    }
}
