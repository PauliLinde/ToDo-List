<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Action;
use App\Form\Type\ActionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActionControllerSvelte extends AbstractController
{

    #[Route('/svelte/actions', name: 'svelte_get_actions')]
    public function getAllActions(EntityManagerInterface $entityManager): Response{
        $actions = $entityManager->getRepository(Action::class)->findAll();

        $actionData = array_map(function($action) {
            return $action->jsonSerialize();
        }, $actions);

        return $this->render('todolist.svelte.html.twig', [
            'actions' => $actionData,
        ]);
    }

    #[Route('/svelte/actions/add', name: 'svelte_add_action', methods: ['GET','POST'])]
    public function addAction(Request $request, EntityManagerInterface $entityManager): Response{

        $action = new Action();

        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $action = $form->getData();
            $entityManager->persist($action);
            $entityManager->flush();
            return $this->redirectToRoute('svelte_get_actions');
        }

        return $this->render('Add.svelte.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/svelte/actions/edit/{id}', name: 'svelte_edit_action', methods: ['GET', 'POST'])]
    public function editAction(EntityManagerInterface $entityManager, int $id,
                               Request $request): Response{

        $action = $entityManager->getRepository(Action::class)->find($id);

        if(!$action){
            throw $this->createNotFoundException(("Action not found"));
        }

        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $action = $form->getData();

            $entityManager->persist($action);
            $entityManager->flush();
            return $this->redirectToRoute('svelte_get_actions');
        }

        return $this->render('Update.svelte.html.twig', [
            'form' => $form->createView(),
            'action' => $action,
        ]);
    }

    #[Route('/svelte/actions/remove/{id}', name: 'svelte_remove_action', methods: 'GET')]
    public function removeAction(EntityManagerInterface $entityManager, int $id): Response{

        error_log("Deleting ID: $id");

        $action = $entityManager->getRepository(Action::class)->find($id);

        if(!$action){
            error_log("Action with ID $id not found!");
            throw $this->createNotFoundException("Action not found");
        }

        error_log("Found action to delete: " . $action->getAction());

        $entityManager->remove($action);
        $entityManager->flush();

        return $this->redirectToRoute('svelte_get_actions');
    }

    #[Route('/svelte/test', name: 'test_svelte')]
    public function test(): Response
    {
        return $this->render('test.svelte.html.twig');
    }
}
