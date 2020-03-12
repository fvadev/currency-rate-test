<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Interface ICurrencyRateCacheStorage
 * @package CurrencyRate
 */
interface ICurrencyRateCacheStorage
{
    /**
     * Set currency rate in cache storage
     *
     * @param ICurrencyRate $currency_rate
     * @return mixed
     */
    public function set(ICurrencyRate $currency_rate);

    /**
     * Get currency rate from cache storage
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function get(string $from_currency_code, string $to_currency_code): ICurrencyRate;
}