<?php

declare(strict_types=1);

namespace Core;

class Serializer
{

    public const ENCODER_JSON = 'json';

    private const VALID_ENCODER = [
        self::ENCODER_JSON
    ];

    private static array $encoderFunctionLookup = [
        self::ENCODER_JSON => 'json_encode'
    ];

    private static array $decoderFunctionLookup = [
        self::ENCODER_JSON => 'json_decode'
    ];

    /**
     * @var string $normalizer
     */
    private string $normalizer;

    /**
     * @var string $encoder
     */
    private string $encoder;

    /**
     * Serializer constructor.
     * @param string $normalizer
     * @param string $encoder
     */
    public function __construct(string $normalizer = null, string $encoder = null)
    {
        $this->normalizer = $normalizer;

        if (!in_array($encoder, self::VALID_ENCODER, true)) {
            throw new \InvalidArgumentException();
        }

        $this->encoder = $encoder;
    }

    /**
     * @param $value
     * @return string
     */
    public function encode($value): string
    {
        $encoder = '';

        switch ($this->encoder) {
            case self::ENCODER_JSON:
                $encoder = static::$encoderFunctionLookup[self::ENCODER_JSON];
                break;
        }

        return $encoder($value);
    }

    public function decode(string $value)
    {
        $decoder = '';

        switch ($this->encoder) {
            case self::ENCODER_JSON:
                $decoder = static::$decoderFunctionLookup[self::ENCODER_JSON];
                break;
        }

        return $decoder($value);
    }
}