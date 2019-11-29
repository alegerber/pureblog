<?php

declare(strict_types=1);

namespace Core;

class JsonResponse
{
    /**
     * @var mixed $content
     */
    private $content;

    /**
     * @var int $statusCode
     */
    private $statusCode;

    /**
     * @var string $header
     */
    private $header;

    /**
     * JsonResponse constructor.
     * @param string $content
     * @param int $statusCode
     * @param string $header
     */
    public function __construct($content, int $statusCode = 200, string $header = '')
    {
        $this->statusCode = $statusCode;
        $this->content    = $content;
        $this->header     = $header;
    }

    public function __toString()
    {
        \header(sprintf('HTTP/1.1 %s OK', $this->statusCode) . $this->header);

        return json_encode(
            $this->content,
            JSON_THROW_ON_ERROR
        );
    }
}
