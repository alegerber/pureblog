<?php declare(strict_types=1);

namespace App\Repository;

use Core\Database;
use Core\Repository;
use App\Model\Comment;

class CommentRepository extends Repository
{
    /**
     * @param Comment $comment
     * @return array
     */
    public function new(Comment $comment): ?array
    {
        $database = Database::getInstance();

        $database->beginTransaction();

        try {
            $statement = $database->prepare(
                'INSERT INTO `comment` (`author`, `author_email`, `body`) VALUES (:author, :author_email, :body)'
            );

            $statement->execute([
                ':author' => $comment->getAuthor(),
                ':author_email' => $comment->getAuthorEmail(),
                ':body' => $comment->getBody()
            ]);

            $database->commit();

            return $statement->fetchAll();
        } catch (\PDOException $exception) {
            $database->rollBack();
            return null;
        }
    }

    /**
     * @param Comment $comment
     * @return array
     */
    public function update(Comment $comment): ?array
    {
        $database = Database::getInstance();

            $statement = $database->prepare(
                'UPDATE `comment` SET `author` = :author, `author_email` = :author_email, `body` = :body WHERE `id` = :id'
            );

            $statement->execute([
                ':author' => $comment->getAuthor(),
                ':author_email' => $comment->getAuthorEmail(),
                ':body' => $comment->getBody(),
                ':id' => $comment->getId()
            ]);

            $database->commit();

            return $statement->fetchAll();
    }

    /**
     * @param Comment $comment
     * @return array
     */
    public function delete(Comment $comment): ?array
    {
        $database = Database::getInstance();

        $database->beginTransaction();

        try {
            $statement = $database->prepare(
                'DELETE FROM `comment` WHERE `id` = :id'
            );

            $statement->execute([
                ':id' => $comment->getId()
            ]);

            $database->commit();

            return $statement->fetchAll();
        } catch (\PDOException $exception){
            $database->rollBack();
            return null;
        }
    }
}
