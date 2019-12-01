<?php declare(strict_types=1);

namespace App\Repository;

use Core\Database;
use App\Model\Comment;

class CommentRepository extends Repository
{
    public function findById(array $ids): ?array
    {
        $database = Database::getInstance();

        try {
            $statement = $database->query('SELECT * FROM `comment`');

            $comments = [];

            foreach ($statement->fetchAll() as $row){
                $comment = new Comment();
                $comment->setAuthor($row['author']);
                $comment->setAuthorEmail($row['author_email']);
                $comment->setBody($row['body']);
                $comments[] = $comment;
            }

            return $comments;
        } catch (\PDOException $exception) {
            return null;
        }
    }

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
