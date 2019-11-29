<?php declare(strict_types=1);

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
        $html = '
            <!DOCTYPE html>
            <html lang="de">
            <head>
                <meta charset="UTF-8">
                <title>Home</title>
                <link rel="stylesheet" type="text/css" href="css/base.css">
                <script type="text/javascript" src="js/base.js"></script>
            </head>
            <body>
            </body>
            </html>
        ';

        return new Response($html);
    }
}
