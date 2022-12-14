# Please note im working on Kali Linux so if any inconvenient happens let me know !

# Using PHP Version 
PHP 8.1.12 (cli) (built: Nov 10 2022 02:42:46) (NTS)

# NB PS : Please run first cp .env.example .env

1) I have a firebase-credentials.json file in the root directory , but i have generated several SDK Keys , if something went wrong feel free to contact me !

2) You have to enable in php.ini

# Using Composer Version
Composer version 2.4.4

# For Firestore Connection :
composer require kreait/laravel-firebase sjhould be installed so run composer update and/or install

# For Firebase :
# Laravel
php artisan vendor:publish --provider="Kreait\Laravel\Firebase\ServiceProvider" --tag=config

You can play with the params to change data
