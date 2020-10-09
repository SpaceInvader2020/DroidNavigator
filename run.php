<?php
if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$config = isset($config) ? $config : [];

use EmpireCli\App;

$app = new App();
$app->runCommand($config);