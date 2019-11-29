<?php declare(strict_types=1);

namespace App\Model;

class Author
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $password
     */
    private $password;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Author
     */
    public function setName(string $name): Author
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Author
     */
    public function setEmail(string $email): Author
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Author
     */
    public function setPassword(string $password): Author
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        return \password_verify($password, $this->password);
    }

    /**
     * @param string $password
     * @return Author
     */
    public function hashPassword(string $password): Author
    {
        $this->password = \password_hash($password, PASSWORD_ARGON2ID);
        return $this;
    }
}