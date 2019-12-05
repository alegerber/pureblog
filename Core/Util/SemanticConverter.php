<?php

declare(strict_types=1);

namespace Core\Util;

class SemanticConverter
{
    public static function camelCaseToSnakeCase(string $input): string
    {
        $matches = [];
        $result = '';

        preg_match('/[A-Z][a-z]*/', $input, $matches);

        $matches[0] = preg_match('/^[a-z]*/', $input);

        foreach ($matches as $match) {
            $result .= strtolower($match) . '_';
        }

        return substr($result,0,-1);
    }

    public static function snakeCaseToCamelCase(string $input): string
    {
        $result = '';

        foreach (explode('_', $input) as $item){
            $result .= ucfirst($item);
        }

        return lcfirst($result);
    }

    public static function pascalCaseToSnakeCase(string $input): string
    {
        $matches = [];
        $result = '';

        preg_match('/[A-Z][a-z]*/', $input, $matches);

        unset($matches[0]);


        foreach ($matches as $match) {
            $result .= strtolower($match) . '_';
        }

        return substr($result,0,-1);
    }

    public static function snakeCaseToPascalCase(string $input): string
    {
        $result = '';

        foreach (explode('_', $input) as $item){
            $result .= ucfirst($item);
        }

        return $result;
    }
}