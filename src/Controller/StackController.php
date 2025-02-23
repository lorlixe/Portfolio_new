<?php

namespace App\Controller;

use App\Entity\Stack;
use App\Form\StackType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StackController extends AbstractController
{
    // #[Route('/stack', name: 'app_stack')]
    // public function index(): Response
    // {
    //     return $this->render('stack/index.html.twig', [
    //         'controller_name' => 'StackController',
    //     ]);
    // }

    #[Route('/stack/new', name: 'app_stack_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/stack/edit', name: 'app_stack_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function new(?Stack $stack, Request $request, EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $stack ??= new Stack();
        $form = $this->createForm(StackType::class, $stack);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $iconFile = $form->get('icon')->getData();

            if ($iconFile) {
                $newFilename = uniqid() . '.' . $iconFile->guessExtension();
                $iconFile->move(
                    $this->getParameter('uploads_directory'), // Dossier de stockage
                    $newFilename
                );
                $stack->setIcon($newFilename); // Enregistre le chemin dans l'entité
            }

            $manager->persist($stack);
            $manager->flush();

            return $this->redirectToRoute('app_main');
        }
        return $this->render('stack/new.html.twig', [
            'controller_name' => 'stack',
            'form' => $form,
            'stack' => $stack
        ]);
    }
}
