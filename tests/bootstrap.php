<?php

echo 'PHP version: ' . phpversion() . PHP_EOL;
echo 'Loaded php.ini: ' . php_ini_loaded_file() . PHP_EOL;
echo 'pdo_mysql loaded: ' . (extension_loaded('pdo_mysql') ? 'yes' : 'no') . PHP_EOL;

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env.test');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}
