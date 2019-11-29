<?php declare(strict_types=1);

namespace App\Model;

class Comment
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var string $author
     */
    private $author;

    /**
     * @var string $authorEmail
     */
    private $authorEmail;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Comment
     */
    public function setBody(string $body): Comment
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Comment
     */
    public function setAuthor(string $author): Comment
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorEmail(): ?string
    {
        return $this->authorEmail;
    }

    /**
     * @param string $authorEmail
     * @return Comment
     */
    public function setAuthorEmail(string $authorEmail): Comment
    {
        $this->authorEmail = $authorEmail;
        return $this;
    }
}