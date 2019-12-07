<?php

declare(strict_types=1);

$config = [];

$config = array_merge($config, include(__DIR__ . '/env/config.php'));
$config = array_merge($config, include(__DIR__ . '/env/config_dev.php'));

spl_autoload_register(function ($className) {
    include __DIR__ . '/../../' . preg_replace('/\\\\/', '/', $className). '.php';
});

require_once 'Routes.php';
