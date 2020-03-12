<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class GetCurrencyRateFromDbBehaviour - Responsible for returning currency rate from database
 * @package CurrencyRate
 */
class GetCurrencyRateFromDbBehaviour implements IGetCurrencyRateBehaviour
{
    /**
     * @var ICurrencyRateDbStorage
     */
    private $storage;

    /**
     * @var IGetCurrencyRateBehaviour
     */
    private $behavior;

    /**
     * GetCurrencyRateFromDbBehaviour constructor.
     * @param IGetCurrencyRateBehaviour $behavior - decorator pattern
     * @param ICurrencyRateDbStorage $storage - db storage resource
     */
    public function __construct(IGetCurrencyRateBehaviour $behavior, ICurrencyRateDbStorage $storage)
    {
        $this->behavior = $behavior;
        $this->storage = $storage;
    }

    /**
     * Get currency rate from Database
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function get(string $from_currency_code, string $to_currency_code): ICurrencyRate
    {
        $currency_rate = $this->storage->load($from_currency_code, $to_currency_code);
        if (!($currency_rate instanceof CurrencyRateNull)) {
            return $currency_rate;
        }

        $currency_rate = $this->behavior->get($from_currency_code, $to_currency_code);
        if (!($currency_rate instanceof CurrencyRateNull)) {
            $this->storage->save($currency_rate);
        }

        return $currency_rate;
    }
}