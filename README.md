
[AutoSkautas.lt](http://elasticar.projektai.nfqakademija.lt/) - car classified aggregator
============

## Code standarts
[![Build Status](https://travis-ci.org/nfqakademija/ElastiCar.svg?branch=master)](https://travis-ci.org/nfqakademija/ElastiCar)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nfqakademija/ElastiCar/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nfqakademija/ElastiCar/?branch=master)

Check the code style before creating a PR by the following command:

```
vendor/bin/phpcs -p --standard=PSR2 --extensions=php ./src
```

## Dependencies
In order to have main functions of the project working, make sure to setup [Auto API](https://github.com/DarkerTH/auto_api) on a remote server and modify `parameters.yml`.

## How to setup

* Create database: `bin/console doctrine:database:create` and `bin/console doctrine:schema:update --force`.
* Fetch all brands and models by executing console commands `bin/console app:insert brand` and `bin/console app:insert model`.
* Run server with `bin/console server:start` and that's it!

## Contributors

* [Tomas Nemeikšis](https://github.com/niumis)

* [Skirmantas Januškas](https://github.com/DarkerTH)

* [Giedrius Skužinskas](giedrskuzins)

## Mentor

* [Žygimantas Rukas](https://github.com/zyrukas)
