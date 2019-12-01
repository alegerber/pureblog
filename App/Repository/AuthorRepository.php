<?php declare(strict_types=1);

namespace App\Repository;

use Core\Database;
use App\Model\Author;

class AuthorRepository extends Repository
{
    /**
     * {@inheritDoc}
     */
    public function find(int $id): ?Author
    {
        $database = Database::getInstance();
        try {
            $statement = $database->prepare('SELECT * FROM `author` WHERE `id` = :id');
            $statement->execute([':id' => $id]);
            $row = $statement->fetch();

            $author = new Author();
            $author->setName($row['name']);
            $author->setEmail($row['email']);
            $author->setPassword($row['password']);

            return $author;
        } catch (\PDOException $exception) {
            return null;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function findAll(): ?array
    {
        $database = Database::getInstance();

        try {
            $statement = $database->query('SELECT * FROM `author`');

            $authors = [];

            foreach ($statement->fetchAll() as $row){
                $author = new Author();
                $author->setName($row['name']);
                $author->setEmail($row['email']);
                $author->setPassword($row['password']);
                $authors[] = $author;
            }

            return $authors;
        } catch (\PDOException $exception) {
            return null;
        }
    }


    /**
     * @param Author $author
     * @return array
     */
    public function new(Author $author): ?array
    {
        $database = Database::getInstance();

        $statement = $database->prepare(
            'INSERT INTO `author` (`name`, `email`, `password`) VALUES (:name, :email, :password)'
        );

        $statement->execute([
            ':name' => $author->getName(),
            ':email' => $author->getEmail(),
            ':password' => $author->getPassword()
        ]);

        $database->commit();

        return $statement->fetchAll();
    }

    /**
     * @param Author $author
     * @return array
     */
    public function update(Author $author): ?array
    {
        $database = Database::getInstance();

        $statement = $database->prepare(
            'UPDATE `author` SET `name` = :name, `email` = :aemail, `password` = :password WHERE `id` = :id'
        );

        $statement->execute([
            ':name' => $author->getName(),
            ':email' => $author->getEmail(),
            ':password' => $author->getPassword(),
            ':id' => $author->getId()
        ]);

        $database->commit();

        return $statement->fetchAll();
    }

    /**
     * @param Author $author
     * @return array
     */
    public function delete(Author $author): ?array
    {
        $database = Database::getInstance();

        $statement = $database->prepare(
            'DELETE FROM `author` WHERE `id` = :id'
        );

        $statement->execute([
            ':id' => $author->getId()
        ]);

        $database->commit();

        return $statement->fetchAll();
    }
}
