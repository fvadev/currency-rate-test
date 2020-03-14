<?php
/**
 * @author Viacheslav Fedorenko <fvadev@gmail.com>
 * @package  fvadev/currency-rate-test
 */

use CurrencyRate\CurrencyRate;
use CurrencyRate\GetCurrencyRateFromCacheBehaviour;
use CurrencyRate\GetCurrencyRateFromDbBehaviour;
use CurrencyRate\GetCurrencyRateFromHttpBehaviour;
use CurrencyRate\GetCurrencyRateNullBehaviour;
use CurrencyRate\CurrencyRateHttpResource;
use CurrencyRate\CurrencyRateDbStorage;
use CurrencyRate\CurrencyRateCacheStorage;
use CurrencyRate\CouldNotRetrieveCurrencyRateException;

require "vendor/autoload.php";

try {
    $currency_rate = new CurrencyRate("USD", "RUR",
        new GetCurrencyRateFromCacheBehaviour(
            new GetCurrencyRateFromDbBehaviour(
                new GetCurrencyRateFromHttpBehaviour(
                    new GetCurrencyRateNullBehaviour(),
                    new CurrencyRateHttpResource()
                ),
                new CurrencyRateDbStorage()
            ),
            new CurrencyRateCacheStorage()
        )
    );
    echo sprintf("Rate is %.2f", $currency_rate->rate()) . "\n";
} catch (CouldNotRetrieveCurrencyRateException $noRateException) {
    echo "Error: " . $noRateException->getMessage() . "\n";
} catch (\Exception $e) {
    // @TODO process error
}