<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigEnvironment;
use App\Core\Response;

class HomeController
{
    /**
     * ROUTE: /
     *
     * @param TwigEnvironment $twigEnvironment
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(TwigEnvironment $twigEnvironment): Response
    {
        return new Response(
            $twigEnvironment->render(
                'home.html.twig',
                [
                    'home' => 'Welcome to Blog'
                ]
            )
        );
    }
}
