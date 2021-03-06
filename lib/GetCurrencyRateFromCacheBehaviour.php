<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class GetCurrencyRateFromCacheBehaviour - Responsible for returning currency rate from cache
 * @package CurrencyRate
 */
class GetCurrencyRateFromCacheBehaviour implements IGetCurrencyRateBehaviour
{
    /**
     * @var ICurrencyRateCacheStorage
     */
    private $storage;

    /**
     * @var IGetCurrencyRateBehaviour
     */
    private $behavior;

    /**
     * GetCurrencyRateBehaviourFromCache constructor.
     * @param IGetCurrencyRateBehaviour $behavior - decorator pattern
     * @param ICurrencyRateCacheStorage $storage - cache storage resource
     */
    public function __construct(IGetCurrencyRateBehaviour $behavior, ICurrencyRateCacheStorage $storage)
    {
        $this->behavior = $behavior;
        $this->storage = $storage;
    }

    /**
     * Get currency rate from cache
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return float
     * @throws CouldNotRetrieveCurrencyRateException
     */
    public function get(string $from_currency_code, string $to_currency_code): float
    {
        $currency_rate = $this->storage->get($from_currency_code, $to_currency_code);
        if (!is_null($currency_rate)) {
            return $currency_rate;
        }

        $currency_rate = $this->behavior->get($from_currency_code, $to_currency_code);
        $this->storage->set($from_currency_code, $to_currency_code, $currency_rate);

        return $currency_rate;
    }
}