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
     * Set currency rate in the cache
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @param float $currency_rate
     */
    public function set(string $from_currency_code, string $to_currency_code, float $currency_rate): void
    {
        // @TODO save rate in cache engine, catch extensions
    }

    /**
     * Get currency rate from cache
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return float|null
     */
    public function get(string $from_currency_code, string $to_currency_code): ?float
    {
        try {
            // @TODO receive cache data, parse, fill rate, exceptions
//            return 100;
            $rate = null;
            return $rate;
        } catch (\Exception $e) {
            //@TODO Process extensions here
        }

        return null;
    }

}