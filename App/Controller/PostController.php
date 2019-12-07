<?php declare(strict_types=1);

namespace App\Controller;

use App\Model\Post;
use App\Repository\PostRepository;
use Core\JsonResponse;

class PostController
{
    /**
     *  ROUTE: /post
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $postRepository = new PostRepository();

        return new JsonResponse($postRepository->findAll());
    }
}
