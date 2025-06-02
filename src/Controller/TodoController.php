<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TodoController
{

    #[Route('/hello')]
    public function helloWorld(): Response{
        return new Response(
            '<html><body>Hello World</body></html>'
        );
    }
}
