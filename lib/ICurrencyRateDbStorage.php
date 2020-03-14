<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Interface ICurrencyRateDbStorage
 * @package CurrencyRate
 */
interface ICurrencyRateDbStorage
{
    /**
     * Save currency rate in database
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @param float $currency_rate
     */
    public function save(string $from_currency_code, string $to_currency_code, float $currency_rate): void;

    /**
     * Load currency rate in database
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return float|null
     */
    public function load(string $from_currency_code, string $to_currency_code): ?float;
}