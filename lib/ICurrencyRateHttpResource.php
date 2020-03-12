<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Interface ICurrencyRateHttpResource
 * @package CurrencyRate
 */
interface ICurrencyRateHttpResource
{
    /**
     * Get currency rate from HTTP
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function get(string $from_currency_code, string $to_currency_code): ICurrencyRate;
}