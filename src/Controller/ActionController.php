<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Action;
use App\Form\Type\ActionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function PHPUnit\Framework\throwException;

class ActionController extends AbstractController
{

    //Finding all actions from database through ActionRepository
    #[Route('/actions', name: 'get_actions')]
    public function getAllActions(EntityManagerInterface $entityManager): Response{
        $actions = $entityManager->getRepository(Action::class)->findAll();

        return $this->render('todoList.html.twig',
            ['actions' => $actions]);
    }

    //Creating new action with formbuilder, and then saving it to database
    #[Route('/actions/add', name: 'add_action', methods: ['GET','POST'])]
    public function addAction(Request $request, EntityManagerInterface $entityManager): Response{

        $action = new Action();

        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $action = $form->getData();
            $entityManager->persist($action);
            $entityManager->flush();
            return $this->redirectToRoute('get_actions');
        }

        return $this->render('actions/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    //Finding chosen action in database, to fill it in update-form, and then saving the changes
    #[Route('/actions/edit/{id}', name: 'edit_action', methods: ['GET', 'POST'])]
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
            return $this->redirectToRoute('get_actions');
        }

        //if the form is not valid, the update form shows up again
        return $this->render('actions/update.html.twig', [
            'form' => $form->createView(),
            'action' => $action,
        ]);
    }


    //Finding chosen action by id, and removing it from database
    #[Route('/actions/remove/{id}', name: 'remove_action', methods: 'GET')]
    public function removeAction(EntityManagerInterface $entityManager, int $id): Response{

        $action = $entityManager->getRepository(Action::class)->find($id);

        if(!$action){
            throw $this->createNotFoundException(("Action not found"));
        }

        $entityManager->remove($action);
        $entityManager->flush();
        return $this->redirectToRoute('get_actions');
    }
}
