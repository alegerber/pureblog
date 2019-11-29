<?php declare(strict_types=1);

namespace Core;

class Response
{
    /**
     * @var string $content
     */
    private $content;

    /**
     * @var int $statusCode
     */
    private $statusCode;

    /**
     * Response constructor.
     * @param string $content
     * @param int $statusCode
     */
    public function __construct(string $content, int $statusCode = 200)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    public function __toString()
    {
        \header('HTTP/1.1 ' . (string) $this->statusCode . ' OK');
        return $this->content;
    }
}
