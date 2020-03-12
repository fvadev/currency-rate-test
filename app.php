<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\ICurrencyRate;
use CurrencyRate\IGetCurrencyRateBehaviour;
use CurrencyRate\GetCurrencyRateFromCacheBehaviour;
use CurrencyRate\GetCurrencyRateFromDbBehaviour;
use CurrencyRate\GetCurrencyRateFromHttpBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\CurrencyRateHttpResource;
use CurrencyRate\CurrencyRateDbStorage;
use CurrencyRate\CurrencyRateCacheStorage;

require "vendor/autoload.php";

try {
    /**
     * @var  $get_currancy_rate_behaviour IGetCurrencyRateBehaviour
     */
    $get_currancy_rate_behaviour = new GetCurrencyRateFromCacheBehaviour(
        new GetCurrencyRateFromDbBehaviour(
            new GetCurrencyRateFromHttpBehaviour(
                new GetCurrencyRateNullBehaviour(),
                new CurrencyRateHttpResource()
            ),
            new CurrencyRateDbStorage()
        ),
        new CurrencyRateCacheStorage()
    );
    /**
     * @var $currency_rate ICurrencyRate
     */
    $currency_rate = $get_currancy_rate_behaviour->get('USD', 'RUR');
    echo $currency_rate->message() . "\n";
} catch (\Exception $e) {
    // @TODO process error
}