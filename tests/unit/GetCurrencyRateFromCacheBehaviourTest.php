<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\GetCurrencyRateFromCacheBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\CurrencyRateCacheStorage;
use CurrencyRate\CouldNotRetrieveCurrencyRateException;
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
            ->willReturn(null);
        $this->expectException(CouldNotRetrieveCurrencyRateException::class);
        $this->behavior->get('USD', 'RUR');
    }

    public function testGetForExists()
    {
        $this->mockStorage->expects($this->never())
            ->method('set');
        $this->mockStorage->expects($this->any())
            ->method('get')
            ->will(
                $this->returnValueMap(
                    [
                        ['USD', 'RUR', 75.0],
                        ['EUR', 'RUR', 85.0]
                    ]
                )
            );

        $this->assertEquals(75.0, $this->behavior->get('USD', 'RUR'));
        $this->assertEquals(75.0, $this->behavior->get('USD', 'RUR'));
        $this->assertEquals(85.0, $this->behavior->get('EUR', 'RUR'));
    }

    public function testGetWithSave()
    {
        $this->mockStorageStub->expects($this->once())
            ->method('set')
            ->with('EUR', 'RUR', 100.0);
        $this->mockStorageStub->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls(null,
                100.0,
                100.0
            ));

        $this->assertEquals(100.0, $this->behaviorStub->get('EUR', 'RUR'));
        $this->assertEquals(100.0, $this->behaviorStub->get('EUR', 'RUR'));
        $this->assertEquals(100.0, $this->behaviorStub->get('EUR', 'RUR'));
    }
}
