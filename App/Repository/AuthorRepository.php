<?php declare(strict_types=1);

namespace App\Repository;

use Core\Database;
use Core\Repository;
use App\Model\Author;

class AuthorRepository extends Repository
{

    public const MODEL = Author::class;

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
