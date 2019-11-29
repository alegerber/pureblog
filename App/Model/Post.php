<?php declare(strict_types=1);

namespace App\Model;

class Post
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var \DateTime $publishDate
     */
    private $publishDate;

    /**
     * @var Author $author
     */
    private $author;

    /**
     * @var Comment[]|array $comments
     */
    private $comments;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
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
     * @return Post
     */
    public function setBody(string $body): Post
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishDate(): \DateTime
    {
        return $this->publishDate;
    }

    /**
     * @param \DateTime $publishDate
     * @return Post
     */
    public function setPublishDate(\DateTime $publishDate): Post
    {
        $this->publishDate = $publishDate;
        return $this;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return Post
     */
    public function setAuthor(Author $author): Post
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return array
     */
    public function getComments(): ?array
    {
        return $this->comments;
    }

    /**
     * @param array ...$comments
     */
    public function addComments(array ...$comments): void
    {
        foreach ($comments as $comment) {
            if (!\in_array($comment, $this->comments, true)) {
                $this->comments[] = $comment;
            }
        }
    }

    public function removeComments(Comment $comment): void
    {
        $key = \array_keys($this->comments, $comment, true);

        unset($this->comments[$key[0]]);
    }
}