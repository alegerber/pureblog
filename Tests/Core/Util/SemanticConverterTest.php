<?php

declare(strict_types=1);

namespace Tests\Core\Util;

use Tests\AbstractTest;
use Core\Util\SemanticConverter;

class SemanticConverterTest extends AbstractTest
{

    private const PASCAL_CASE = 'TestTestTest';
    private const CAMEL_CASE  = 'testTestTest';
    private const SNAKE_CASE  = 'test_test_test';

    public function testCamelCaseToSnakeCase(): void
    {
        $this->assertSame(self::SNAKE_CASE, SemanticConverter::camelCaseToSnakeCase(self::CAMEL_CASE));
    }


    public function testSnakeCaseToCamelCase(): void
    {
        $this->assertSame(self::CAMEL_CASE, SemanticConverter::snakeCaseToCamelCase(self::SNAKE_CASE));
    }


    public function testPascalCaseToSnakeCase(): void
    {
        $this->assertSame(self::SNAKE_CASE, SemanticConverter::pascalCaseToSnakeCase(self::PASCAL_CASE));
    }


    public function testSnakeCaseToPascalCase(): void
    {
        $this->assertSame(self::PASCAL_CASE, SemanticConverter::snakeCaseToPascalCase(self::SNAKE_CASE));
    }


}