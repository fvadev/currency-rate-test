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
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @param float $currency_rate
     */
    public function set(string $from_currency_code, string $to_currency_code, float $currency_rate): void;

    /**
     * Get currency rate from cache storage
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return float|null
     */
    public function get(string $from_currency_code, string $to_currency_code): ?float;
}