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
     * Get currency rate
     *
     * @return float
     */
    public  function rate(): float;

}