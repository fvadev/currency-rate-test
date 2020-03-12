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
     * @param ICurrencyRate $currency_rate
     * @return mixed
     */
    public function save(ICurrencyRate $currency_rate);

    /**
     * Load currency rate in database
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function load(string $from_currency_code, string $to_currency_code): ICurrencyRate;
}