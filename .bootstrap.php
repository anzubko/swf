<?php

ini_set('display_errors', PHP_SAPI === 'cli');

error_reporting(E_ALL);

ignore_user_abort(PHP_SAPI === 'cli');

setlocale(LC_ALL, 'C');

mb_internal_encoding('UTF-8');

const APP_DIR = __DIR__;

$loader = require __DIR__ . '/vendor/autoload.php';

return new SWF\Runner($loader, i(App\Config\SystemConfig::class));
