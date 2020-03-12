<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Interface ICurrencyRate
 * @package CurrencyRate
 */
interface ICurrencyRate
{
    /**
     * Get message for currency rate
     *
     * @return string
     */
    public function message(): string;
}