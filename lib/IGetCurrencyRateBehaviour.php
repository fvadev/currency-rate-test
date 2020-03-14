<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Interface IGetCurrencyRateBehaviour
 * @package CurrencyRate
 */
interface IGetCurrencyRateBehaviour
{
    /**
     * Get currency rate from behaviour
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return float
     * @throws CouldNotRetrieveCurrencyRateException
     */
    public function get(string $from_currency_code, string $to_currency_code): float;
}