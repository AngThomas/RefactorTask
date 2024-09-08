# MyTask

Comission calculation is launched with symfony command:
php bin/console ProcessTransactions /path/to/input.txt
there is input.txt file in /public/data

When bin API return empty objects, the corresponding commission line will output 0.0

Unit tests are lanched by php vendor/bin/phpuniyt command.

To be able to use exchangeRatesAPI please modify
currency_endpoint in services.yaml in a way:
replace xxx pattern with your own access key.

Project made with PHP 8.3 and Symfony 7
Packages used:
jms serializer with bundle,
phpunit
