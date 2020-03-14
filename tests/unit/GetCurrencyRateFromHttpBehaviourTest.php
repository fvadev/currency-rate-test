<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\GetCurrencyRateFromHttpBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\ICurrencyRateHttpResource;
use CurrencyRate\CouldNotRetrieveCurrencyRateException;

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
            ->willReturn(null);
        $this->expectException(CouldNotRetrieveCurrencyRateException::class);
        $this->behavior->get('USD', 'RUR');
    }

    public function testGetForExists()
    {
        $this->mockResource->expects($this->any())
            ->method('get')
            ->will(
                $this->returnValueMap(
                    [
                        ['USD', 'RUR', 80.0],
                        ['EUR', 'RUR', 90.0]
                    ]
                )
            );

        $this->assertEquals(80.0, $this->behavior->get('USD', 'RUR'));
        $this->assertEquals(90.0, $this->behavior->get('EUR', 'RUR'));
    }
}
