<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class HttpCurrencyRateProcessor - Responsible for returning currency rate from http source
 * @package CurrencyRate
 */
class GetCurrencyRateFromHttpBehaviour implements IGetCurrencyRateBehaviour
{
    /**
     * @var ICurrencyRateHttpResource
     */
    private $resource;

    /**
     * @var IGetCurrencyRateBehaviour
     */
    private $behavior;

    /**
     * HttpCurrencyRateProcessor constructor.
     * @param IGetCurrencyRateBehaviour $behavior - decorator pattern
     * @param ICurrencyRateHttpResource $resource - http resource
     */
    public function __construct(IGetCurrencyRateBehaviour $behavior, ICurrencyRateHttpResource $resource)
    {
        $this->behavior = $behavior;
        $this->resource = $resource;
    }

    /**
     * Get currency rate from http
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function get(string $from_currency_code, string $to_currency_code): ICurrencyRate
    {
        $currency_rate = $this->resource->get($from_currency_code, $to_currency_code);
        if (!($currency_rate instanceof CurrencyRateNull)) {
            return $currency_rate;
        }

        $currency_rate = $this->behavior->get($from_currency_code, $to_currency_code);
        return $currency_rate;
    }
}