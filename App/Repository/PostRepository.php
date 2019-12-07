<?php declare(strict_types=1);

namespace App\Repository;

use Core\Database;
use Core\Repository;
use App\Model\Post;

class PostRepository extends Repository
{

    /**
     * @param Post $post
     * @return array
     */
    public function new(Post $post): ?array
    {
        $database = Database::getInstance();

        $database->beginTransaction();

        try {
            $statement = $database->prepare(
                'INSERT INTO `post` (`title`, `body`, `publish_date`, `author_id`, `comment_ids`) VALUES (:title, :body, :publish_date, :author_id, :comment_ids)'
            );

            $statement->execute([
                ':title' => $post->getTitle(),
                ':body' => $post->getBody(),
                ':publish_date' => $post->getPublishDate(),
                ':author_id' => $post->getAuthor()->getId(),
                ':comment_ids' => null
            ]);

            $authorRepository = new AuthorRepository();
            $authorRepository->new($post->getAuthor());

            $database->commit();

            return $statement->fetchAll();
        } catch (\PDOException $exception) {
            $database->rollBack();
            return null;
        }
    }

    /**
     * @param Post $post
     * @return array
     */
    public function update(Post $post): ?array
    {
        $database = Database::getInstance();

        $database->beginTransaction();

        try {
            $statement = $database->prepare(
                'UPDATE `post` SET `title` = :title, `body` = :body, `publish_date` = :publish_date, `author_id` = :author_id, `comment_ids` = :comment_ids WHERE `id` = :id'
            );

            $statement->execute([
                ':title' => $post->getTitle(),
                ':body' => $post->getBody(),
                ':publish_date' => $post->getPublishDate(),
                ':author_id' => $post->getAuthor()->getId(),
                ':comment_ids' => \serialize($post->getComments()),
                ':id' => $post->getId()
            ]);

            $authorRepository = new AuthorRepository();
            $authorRepository->update($post->getAuthor());
            $commentRepository = new CommentRepository();
            if ($post->getComments() !== null) {
                foreach ($post->getComments() as $comment) {
                    $commentRepository->update($comment);
                }
            }
            $database->commit();

            return $statement->fetchAll();

        } catch (\PDOException $exception){
            $database->rollBack();
            return null;
        }
    }

    /**
     * @param Post $post
     * @return array
     */
    public function delete(Post $post): ?array
    {
        $database = Database::getInstance();

        $database->beginTransaction();

        try {
            $statement = $database->prepare(
                'DELETE FROM `post` WHERE `id` = :id'
            );

            $statement->execute([
                ':id' => $post->getId()
            ]);

            $authorRepository = new AuthorRepository();
            $authorRepository->delete($post->getAuthor());
            $commentRepository = new CommentRepository();
            if ($post->getComments() !== null) {
                foreach ($post->getComments() as $comment) {
                    $commentRepository->delete($comment);
                }
            }
            $database->commit();

            return $statement->fetchAll();
        } catch (\PDOException $exception){
            $database->rollBack();
            return null;
        }
    }
}
