<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Router;
use App\Core\TwigEnvironment;
use App\Core\Response;
use App\Models\Post;
use App\Repository\PostRepository;

class PostController
{
    /**
     *  ROUTE: /post
     *
     * @param TwigEnvironment $twigEnvironment
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): Response
    {
        $postRepository = new PostRepository();

        return new Response(
            $twigEnvironment->render(
                'post.html.twig',
                [
                    'posts' => $postRepository->getPosts()
                ]
            )
        );
    }

    /**
     * ROUTE: /post/new
     *
     * @param TwigEnvironment $twigEnvironment
     * @return Response|void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function new(TwigEnvironment $twigEnvironment)
    {
        if (isset($_POST['title'])) {
            $postRepository = new PostRepository();
            $postRepository->beginTransaction();
            try {
                $post = new Post();
                $post->setTitle($_POST['title']);
//                $post->setAuthor($_POST['author']);
//                $post->setComment($_POST['comment']);
//                $post->setAuthorEmail($_POST['author_email']);

                $postRepository->newPost($post);
                $postRepository->commit();
            } catch (\PDOException $exception) {
                $postRepository->rollBack();
                return new Response($exception->getMessage(), 500);
            }

            $router = Router::getInstance();
            $router->callController('/posts');
        }

        return new Response($twigEnvironment->render('new_post.html.twig'));
    }
}
