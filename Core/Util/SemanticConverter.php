<?php

declare(strict_types=1);

namespace Core\Util;

class SemanticConverter
{
    /**
     * @param string $input
     * @return string
     */
    public static function camelCaseToSnakeCase(string $input): string
    {
        $matches = [];
        $matchesSecond = [];
        $result = '';

        preg_match_all('/[A-Z][a-z]*/', $input, $matches);

        $matches = $matches[0];

        preg_match('/^[a-z]*/', $input,$matchesSecond);

        $matchesAll = array_merge($matchesSecond, $matches);

        foreach ($matchesAll as $match) {
            $result .= strtolower($match) . '_';
        }

        return substr($result,0,-1);
    }


    /**
     * @param string $input
     * @return string
     */
    public static function snakeCaseToCamelCase(string $input): string
    {
        $result = '';

        foreach (explode('_', $input) as $item){
            $result .= ucfirst($item);
        }

        return lcfirst($result);
    }


    /**
     * @param string $input
     * @return string
     */
    public static function pascalCaseToSnakeCase(string $input): string
    {
        $matches = [];
        $result = '';

        preg_match_all('/[A-Z][a-z]*/', $input, $matches);

        $matches = $matches[0];

        foreach ($matches as $match) {
            $result .= strtolower($match) . '_';
        }

        return substr($result,0,-1);
    }


    /**
     * @param string $input
     * @return string
     */
    public static function snakeCaseToPascalCase(string $input): string
    {
        $result = '';

        foreach (explode('_', $input) as $item){
            $result .= ucfirst($item);
        }

        return $result;
    }
}