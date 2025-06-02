<?php

namespace App\Controller;

use App\Entity\TodoList;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActionController extends AbstractController
{

    #[Route('/actions', name: 'get_actions')]
    public function getAllActions(EntityManagerInterface $entityManager, int $id): Response{
        $todoList = $entityManager->getRepository(TodoList::class)->find($id);

        $actions = $todoList->getActions();
        return new Response(
            '<html><body>Hello World</body></html>'
        );
    }
}
