<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\GetCurrencyRateFromDbBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\CurrencyRateDbStorage;
use CurrencyRate\CouldNotRetrieveCurrencyRateException;
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
            ->willReturn(null);
        $this->expectException(CouldNotRetrieveCurrencyRateException::class);
        $this->behavior->get('USD', 'RUR');
    }

    public function testGetForExists()
    {
        $this->mockStorage->expects($this->never())
            ->method('save');
        $this->mockStorage->expects($this->any())
            ->method('load')
            ->will(
                $this->returnValueMap(
                    [
                        ['USD', 'RUR', 80.0],
                        ['EUR', 'RUR', 90.0]
                    ]
                )
            );

        $this->assertEquals(80.0, $this->behavior->get('USD', 'RUR'));
        $this->assertEquals(80.0, $this->behavior->get('USD', 'RUR'));
        $this->assertEquals(90.0, $this->behavior->get('EUR', 'RUR'));
    }

    public function testGetWithSave()
    {
        $this->mockStorageStub->expects($this->once())
            ->method('save');
        $this->mockStorageStub->expects($this->any())
            ->method('load')
            ->will($this->onConsecutiveCalls(null,
                100.0,
                100.0
            ));

        $this->assertEquals(100.0, $this->behaviorStub->get('EUR', 'RUR'));
        $this->assertEquals(100.0, $this->behaviorStub->get('EUR', 'RUR'));
    }
}
