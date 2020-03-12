<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class CurrencyRateCacheStorage - Responsible for storing data in cache
 * @package CurrencyRate
 */
class CurrencyRateCacheStorage implements ICurrencyRateCacheStorage
{
    /**
     * @var ICacheStorage - interface for working with cache storage
     */
    private $storage;

    /**
     * CurrencyRateDbStorage constructor.
     *
     * @param ICacheStorage $cache_storage - cache storage resource
     */
    public function __construct(/* ICacheStorage $cache_storage */)
    {
        //@TODO cache storage
        $this->storage;
    }

    /**
     * Save currency rate in the cache
     *
     * @param ICurrencyRate $currency_rate
     */
    public function set(ICurrencyRate $currency_rate)
    {
        // @TODO save rate in cache engine, catch extensions
    }

    /**
     * Get currency rate from cache
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function get(string $from_currency_code, string $to_currency_code): ICurrencyRate
    {
        try {
            // @TODO receive cache data, parse, fill values, exceptions
//            return new CurrencyRate(100, $from_currency_code, $to_currency_code);
            return new CurrencyRateNull();
            $rate = 0;
            return new CurrencyRate($rate, $from_currency_code, $to_currency_code);
        } catch (\Exception $e) {
            //@TODO Process extensions here
        }

        return new CurrencyRateNull();
    }

}