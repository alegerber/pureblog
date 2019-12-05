<?php

declare(strict_types=1);

$config = [];

//$config = array_merge($config, include('./../App/config/env/config.php'));
//$config = array_merge($config, include('./../App/config/env/config_test.php'));


spl_autoload_register(function ($className) {
    include __DIR__ . '/../' . preg_replace('/\\\\/', '/', $className). '.php';
});

$semanticConverterTest = new \Tests\Core\Util\SemanticConverterTest();
$semanticConverterTest->testCamelCaseToSnakeCase();
$semanticConverterTest->testSnakeCaseToCamelCase();
$semanticConverterTest->testPascalCaseToSnakeCase();
$semanticConverterTest->testSnakeCaseToPascalCase();