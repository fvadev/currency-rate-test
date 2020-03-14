# currency-rate-test

# Usage
```
php app.php
```

# TestRun
```
vendor/bin/phpunit
```

# Classes
- CurrencyRate -- Currency rate object
- CurrencyRateCacheStorage|CurrencyRateDbStorage|CurrencyRateHttpResource - Classes responsible for retrieving rate information form resources (Cache|DataBase|Http)
- GetCurrencyRateFromCacheBehaviour|GetCurrencyRateFromDbBehaviour|GetCurrencyRateFromHttpBehaviour|GetCurrencyRateNullBehaviour - Behaviours which provide ride information for CurrencyRate
- CouldNotRetrieveCurrencyRateException - Exception if currency rate impossible to retrieve

# TODO
- Realisation of resources (CurrencyRateCacheStorage|CurrencyRateDbStorage|CurrencyRateHttpResource)
- Collection

# Notes
I assumed that if currency rate is impossible to retrieve then CouldNotRetrieveCurrencyRateException is raised.
I assumed that all resources catch all extensions entirely. If resource do not have currency rate it returns null.

 
