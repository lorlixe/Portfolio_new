<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategorieController extends AbstractController
{
    // #[Route('/categorie', name: 'app_categorie')]
    // public function index(): Response
    // {
    //     return $this->render('categorie/index.html.twig', [
    //         'controller_name' => 'CategorieController',
    //     ]);
    // }

    public function index(CategorieRepository $repository): Response
    {
        $categories = $repository->findAll();
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'categories' => $categories,

        ]);
    }

    #[Route('/categorie/new', name: 'app_categorie_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/categorie/edit', name: 'app_categorie_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function new(?Categorie $categorie, Request $request, EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $categorie ??= new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('app_main');
        }
        return $this->render('categorie/new.html.twig', [
            'controller_name' => 'categorie',
            'form' => $form,
            'categorie' => $categorie
        ]);
    }
}
