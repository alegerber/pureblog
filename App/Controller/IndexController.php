<?php

declare(strict_types=1);

namespace App\Controller;

use Core\Response;

class IndexController
{
    /**
     * ROUTE: /
     *
     * @return Response
     */
    public function index(): Response
    {
        $html = file_get_contents(__DIR__ . '/../views/index.html');

        return new Response($html);
    }
}
