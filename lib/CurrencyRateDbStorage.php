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
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @param float $currency_rate
     */
    public function save(string $from_currency_code, string $to_currency_code, float $currency_rate): void
    {
        // @TODO save currency rate in specific DB, catch extensions
    }

    /**
     * Load currency rate from database
     *
     * @param string $from_currency_code
     * @param string $to_currency_code
     * @return float|null
     */
    public function load(string $from_currency_code, string $to_currency_code): ?float
    {
        try {
            // @TODO making DB request, fill rate, exceptions
//            return 90;
            $rate = null;
            return $rate;
        } catch (\Exception $e) {
            //@TODO Process extensions here
        }

        return null;
    }

}