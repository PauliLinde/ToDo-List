<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ActionRepository;
use App\Entity\Action;
use App\Form\Type\ActionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function PHPUnit\Framework\throwException;

class ActionController extends AbstractController
{

    #[Route('/actions', name: 'get_actions')]
    public function getAllActions(EntityManagerInterface $entityManager): Response{
        $actions = $entityManager->getRepository(Action::class)->findAll();

        /*if(!$actions){
            throw $this->createNotFoundException(("Actions not found"));
        }*/

        /*return $this->render('todoList.html.twig',
            ['actions' => $actions]);*/
        return $this->render('page.server.js',
            ['actions' => $actions]);
    }

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

        return $this->render('actions/update.html.twig', [
            'form' => $form->createView(),
            'action' => $action,
        ]);
    }

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
