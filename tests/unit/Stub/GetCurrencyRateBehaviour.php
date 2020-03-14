<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRateTest\Stub;

use CurrencyRate\IGetCurrencyRateBehaviour;

class GetCurrencyRateBehaviour implements IGetCurrencyRateBehaviour
{
    public function get(string $from_currency_code, string $to_currency_code): float
    {
        return 100.0;
    }
}