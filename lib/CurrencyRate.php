<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class CurrencyRate
 * @package CurrencyRate
 */
class CurrencyRate implements ICurrencyRate
{
    private $from_currency_code;
    private $to_currency_code;
    private $currency_rate;

    /**
     * CurrencyRate constructor.
     * @param float $currency_rate - currency rate
     * @param string $from_currency_code - currency from code
     * @param string $to_currency_code - currency to code
     */
    public function __construct(float $currency_rate, string $from_currency_code, string $to_currency_code)
    {
        $this->currency_rate = $currency_rate;
        $this->from_currency_code = $from_currency_code;
        $this->to_currency_code = $to_currency_code;
    }

    /**
     * Get message with rate information
     *
     * @return string
     */
    public function message(): string
    {
        return sprintf("1 %s is %.2f %s", $this->from_currency_code, $this->currency_rate, $this->to_currency_code);
    }
}