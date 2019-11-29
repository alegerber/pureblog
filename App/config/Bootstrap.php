<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    include __DIR__ . '../../' . preg_replace('/\\\\/', '/', $className). '.php';
});

require_once 'Routes.php';
