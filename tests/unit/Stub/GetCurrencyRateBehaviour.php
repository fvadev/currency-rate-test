<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRateTest\Stub;

use CurrencyRate\ICurrencyRate;
use CurrencyRate\IGetCurrencyRateBehaviour;
use CurrencyRate\CurrencyRate;

class GetCurrencyRateBehaviour implements IGetCurrencyRateBehaviour
{
    public function get(string $from_currency_code, string $to_currency_code): ICurrencyRate
    {
        return new CurrencyRate("100", "EUR", "RUR");
    }
}