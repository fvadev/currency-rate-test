<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

namespace CurrencyRate;

/**
 * Class CurrencyRateDbStorage - Responsible for storing data in DB
 * @package CurrencyRate
 */
class CurrencyRateDbStorage implements ICurrencyRateDbStorage
{
    /**
     * @var IDbStorage - interface for working with db storage
     */
    private $storage;

    /**
     * CurrencyRateDbStorage constructor.
     *
     * @param IDbStorage $db_storage - db storage resource
     */
    public function __construct(/* IDbStorage $db_storage */)
    {
        //@TODO db storage
        $this->storage;// = $db_storage
    }

    /**
     * Save currency rate in database
     *
     * @param ICurrencyRate $currency_rate
     */
    public function save(ICurrencyRate $currency_rate)
    {
        // @TODO save currency rate in specific DB, catch extensions
    }

    /**
     * Load currency rate from database
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return ICurrencyRate
     */
    public function load(string $from_currency_code, string $to_currency_code): ICurrencyRate
    {
        try {
            // @TODO making DB request, fill values, exceptions or return null rate
//            return new CurrencyRate(90, $from_currency_code, $to_currency_code);
            return new CurrencyRateNull();
            $rate = 0;
            return new CurrencyRate($rate, $from_currency_code, $to_currency_code);
        } catch (\Exception $e) {
            //@TODO Process extensions here
        }

        return new CurrencyRateNull();
    }

}