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
     * @return float|null
     */
    public function get(string $from_currency_code, string $to_currency_code): ?float
    {
        try {
            // @TODO making request, receive and parse result, fill rate, exceptions
//            return 75.5;
            $rate = null;
            return $rate;
        } catch (\Exception $e) {
            //@TODO Process extensions here
        }

        return null;
    }
}