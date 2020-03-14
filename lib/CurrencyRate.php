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
    private $get_rate_behaviour;

    /**
     * CurrencyRate constructor.
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @param IGetCurrencyRateBehaviour $get_rate_behaviour
     */
    public function __construct(
        string $from_currency_code,
        string $to_currency_code,
        IGetCurrencyRateBehaviour $get_rate_behaviour
    )
    {
        $this->from_currency_code = $from_currency_code;
        $this->to_currency_code = $to_currency_code;
        $this->get_rate_behaviour = $get_rate_behaviour;
    }

    /**
     * Get currency rate
     *
     * @return float
     * @throws CouldNotRetrieveCurrencyRateException
     */
    public function rate(): float
    {
        return $this->get_rate_behaviour->get($this->from_currency_code, $this->to_currency_code);
    }
}