<?php

declare(strict_types=1);

namespace Tests;

class AbstractTest
{

    protected function assertSame($expected, $actual): void
    {
        if ($expected === $actual) {
            echo 'Test Passed' . PHP_EOL;
        }

        echo 'Test Failed' . PHP_EOL;
    }
}