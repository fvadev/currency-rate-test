<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class CurrencyRateNull - null object
 * @package CurrencyRate
 */
class CurrencyRateNull implements ICurrencyRate
{
    /**
     * Get message with null rate information
     *
     * @return string
     */
    public function message(): string
    {
        return sprintf("Nothing");
    }
}