<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\GetCurrencyRateFromCacheBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\CurrencyRateCacheStorage;
use CurrencyRate\CurrencyRateNull;
use CurrencyRate\CurrencyRate;
use CurrencyRateTest\Stub\GetCurrencyRateBehaviour;

class GetCurrencyRateFromCacheBehaviourTest extends PHPUnit\Framework\TestCase
{
    private $behavior;
    private $behaviorNull;
    private $behaviorStub;
    private $mockStorage;
    private $mockStorageNull;
    private $mockStorageStub;

    protected function setUp():void
    {
        $this->mockStorage = $this->getMockBuilder(CurrencyRateCacheStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockStorageNull = $this->getMockBuilder(CurrencyRateCacheStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockStorageStub = $this->getMockBuilder(CurrencyRateCacheStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->behaviorNull = new GetCurrencyRateFromCacheBehaviour(new GetCurrencyRateNullBehaviour(), $this->mockStorageNull);
        $this->behavior = new GetCurrencyRateFromCacheBehaviour(new GetCurrencyRateNullBehaviour(), $this->mockStorage);
        $this->behaviorStub = new GetCurrencyRateFromCacheBehaviour(new GetCurrencyRateBehaviour(), $this->mockStorageStub);

    }

    public function testGetForEmpty()
    {
        $this->mockStorageNull->expects($this->never())
            ->method('set');
        $this->mockStorageNull->expects($this->any())
            ->method('get')
            ->with('USD', 'RUR')
            ->willReturn(new CurrencyRateNull());
        $this->assertInstanceOf(CurrencyRateNull::class, $this->behaviorNull->get('USD', 'RUR'));
    }

    public function testGetForExists()
    {
        $this->mockStorage->expects($this->never())
            ->method('set');
        $this->mockStorage->expects($this->any())
            ->method('get')
            ->with('USD', 'RUR')
            ->willReturn(new CurrencyRate(75, 'USD', 'RUR'));

        $this->assertEquals("1 USD is 75.00 RUR", $this->behavior->get('USD', 'RUR')->message());
        $this->assertEquals("1 USD is 75.00 RUR", $this->behavior->get('USD', 'RUR')->message());
    }

    public function testGetWithSave()
    {
        $this->mockStorageStub->expects($this->once())
            ->method('set')
            ->with(new CurrencyRate(100, 'EUR', 'RUR'));
        $this->mockStorageStub->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls(new CurrencyRateNull(),
                new CurrencyRate(100, 'EUR', 'RUR'),
                new CurrencyRate(100, 'EUR', 'RUR')
            ));

        $this->assertEquals("1 EUR is 100.00 RUR", $this->behaviorStub->get('EUR', 'RUR')->message());
        $this->assertEquals("1 EUR is 100.00 RUR", $this->behaviorStub->get('EUR', 'RUR')->message());
    }
}
