<?php

define('APP_STARTED', gettimeofday(true));

require __DIR__ . '/vendor/autoload.php';

const APP_DIR = __DIR__;

ini_set('display_errors', 'cli' === PHP_SAPI);
ini_set('error_reporting', E_ALL);
ini_set('ignore_user_abort', true);

setlocale(LC_ALL, 'C');

mb_internal_encoding('UTF-8');

return new SWF\Runner();
