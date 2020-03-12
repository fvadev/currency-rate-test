<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\CurrencyRate;

class CurrencyRateTest extends \PHPUnit\Framework\TestCase
{

    private $currency_rate;

    protected function setUp():void
    {
        $this->currency_rate = new CurrencyRate(75.5, "USD", "RUR");
    }

    public function testMessage()
    {
        $this->assertEquals("1 USD is 75.50 RUR",  $this->currency_rate->message(),"Currency rate format are incorrect");
    }
}
