<?php declare(strict_types = 1);

ini_set('display_errors', PHP_SAPI === 'cli');

error_reporting(E_ALL);

ignore_user_abort(PHP_SAPI === 'cli');

setlocale(LC_ALL, 'C');

mb_internal_encoding('UTF-8');

const APP_DIR = __DIR__;

require APP_DIR . '/vendor/autoload.php';

return App\Runner::getInstance();
