<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class CurrencyRateHttpResource - Responsible for getting currency rate via HTTP request
 * @package CurrencyRate
 */
class CurrencyRateHttpResource implements ICurrencyRateHttpResource
{
    /**
     * @var IHttpResource - interface for working with http request
     */
    private $resource;

    /**
     * CurrencyRateHttpResource constructor.
     * @param IHttpResource $http_resource - http request resource
     */
    public function __construct(/* IHttpResource $http_resource */)
    {
        //@TODO http resource
        $this->resource;
    }

    /**
     * Getting currency rate
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function get(string $from_currency_code, string $to_currency_code): ICurrencyRate
    {
        try {
            // @TODO making request, receive and parse result, fill values, exceptions
//            return new CurrencyRate(75, $from_currency_code, $to_currency_code);
            return new CurrencyRateNull();
            $rate = $from_currency = $to_currency = null;
            return new CurrencyRate($rate, $from_currency_code, $to_currency_code);
        } catch (\Exception $e) {
            //@TODO Process extensions here
        }

        return new CurrencyRateNull();
    }
}