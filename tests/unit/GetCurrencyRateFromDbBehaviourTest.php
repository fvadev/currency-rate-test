<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\GetCurrencyRateFromDbBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\CurrencyRateDbStorage;
use CurrencyRate\CurrencyRateNull;
use CurrencyRate\CurrencyRate;
use CurrencyRateTest\Stub\GetCurrencyRateBehaviour;

class GetCurrencyRateFromDbBehaviourTest extends PHPUnit\Framework\TestCase
{
    private $behavior;
    private $behaviorNull;
    private $behaviorStub;
    private $mockStorage;
    private $mockStorageNull;
    private $mockStorageStub;

    protected function setUp():void
    {
        $this->mockStorage = $this->getMockBuilder(CurrencyRateDbStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockStorageNull = $this->getMockBuilder(CurrencyRateDbStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockStorageStub = $this->getMockBuilder(CurrencyRateDbStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->behaviorNull = new GetCurrencyRateFromDbBehaviour(new GetCurrencyRateNullBehaviour(), $this->mockStorageNull);
        $this->behavior = new GetCurrencyRateFromDbBehaviour(new GetCurrencyRateNullBehaviour(), $this->mockStorage);
        $this->behaviorStub = new GetCurrencyRateFromDbBehaviour(new GetCurrencyRateBehaviour(), $this->mockStorageStub);

    }

    public function testGetForEmpty()
    {
        $this->mockStorageNull->expects($this->never())
            ->method('save');
        $this->mockStorageNull->expects($this->any())
            ->method('load')
            ->with('USD', 'RUR')
            ->willReturn(new CurrencyRateNull());
        $this->assertInstanceOf(CurrencyRateNull::class, $this->behaviorNull->get('USD', 'RUR'));
    }

    public function testGetForExists()
    {
        $this->mockStorage->expects($this->never())
            ->method('save');
        $this->mockStorage->expects($this->any())
            ->method('load')
            ->with('USD', 'RUR')
            ->willReturn(new CurrencyRate(80, 'USD', 'RUR'));

        $this->assertEquals("1 USD is 80.00 RUR", $this->behavior->get('USD', 'RUR')->message());
        $this->assertEquals("1 USD is 80.00 RUR", $this->behavior->get('USD', 'RUR')->message());
    }

    public function testGetWithSave()
    {
        $this->mockStorageStub->expects($this->once())
            ->method('save');
        $this->mockStorageStub->expects($this->any())
            ->method('load')
            ->will($this->onConsecutiveCalls(new CurrencyRateNull(),
                new CurrencyRate(100, 'EUR', 'RUR'),
                new CurrencyRate(100, 'EUR', 'RUR')
            ));

        $this->assertEquals("1 EUR is 100.00 RUR", $this->behaviorStub->get('EUR', 'RUR')->message());
        $this->assertEquals("1 EUR is 100.00 RUR", $this->behaviorStub->get('EUR', 'RUR')->message());
    }
}
