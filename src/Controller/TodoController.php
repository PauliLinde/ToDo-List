<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController
{

    #[Route('/hello')]
    public function helloWorld(): Response{
        return new Response(
            '<html><body>Hello World</body></html>'
        );
    }

    #[Route('/list')]
    public function getTodoList(): Response{
        return new Response(
            '<html><body>Hello World</body></html>'
        );
    }
}
