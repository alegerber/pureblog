<?php declare(strict_types=1);

namespace App\Controller;

use Core\JsonResponse;

class IndexController
{
    /**
     * ROUTE: /
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['test' => 'test']);
    }
}
