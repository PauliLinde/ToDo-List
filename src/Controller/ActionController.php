<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\TodoList;
use phpDocumentor\Reflection\PseudoTypes\IntegerValue;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActionController extends AbstractController
{

    #[Route('/actions', name: 'get_actions')]
    public function getAllActions(EntityManagerInterface $entityManager, int $id): Response{
        $todoList = $entityManager->getRepository(TodoList::class)->find($id);

        $actions = $todoList->getActions();
        return $this->render('todoList.html',['actions' => $actions]);
    }

    #[Route('/actions/add', name: 'add_action', methods: 'Post')]
    public function addAction(Request $request): Response{

        $action = new Action();
        $action -> setAction($action);
        $action -> setTodoList($listId);

        $form = $this->createFormBuilder($action)
        ->add('action', TextType::class)
        ->add('listId', IntegerValue::class)
        ->add('save', SubmitType::class, ['label' => 'Add'])
        ->getForm();
        return $this->redirectToRoute('/actions');
    }
}
