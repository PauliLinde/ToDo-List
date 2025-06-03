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

class ActionController extends AbstractController
{

    #[Route('/actions', name: 'get_actions')]
    public function getAllActions(EntityManagerInterface $entityManager): Response{
        $actions = $entityManager->getRepository(ActionRepository::class)->findAll();

        return $this->render('todoList.html',['actions' => $actions]);
    }

    #[Route('/actions/add', name: 'add_action', methods: ['Get','Post'])]
    public function addAction(Request $request, ActionRepository $actionRepo): Response{

        $action = new Action();

        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $action = $form->getData();
            $actionRepo->save($action, true);
            return $this->redirectToRoute('get_actions');
        }

        return $this->render('actions/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
