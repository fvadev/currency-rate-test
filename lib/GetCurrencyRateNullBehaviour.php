<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class GetCurrencyRateNullBehaviour - Responsible for returning null currency rate object
 * @package CurrencyRate
 */
class GetCurrencyRateNullBehaviour implements IGetCurrencyRateBehaviour
{
    /**
     * Get currency rate with from null behaviour
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return float
     * @throws CouldNotRetrieveCurrencyRateException
     */
    public function get(string $from_currency_code, string $to_currency_code): float
    {
        throw new CouldNotRetrieveCurrencyRateException("Currency rate cannot be retrieved.");
    }
}