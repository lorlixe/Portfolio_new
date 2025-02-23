<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function index(ProjectRepository $repository): Response
    {
        $projects = $repository->findAll();

        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projects,

        ]);
    }


    #[Route('project/{id}', name: 'app_project_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(?Project $project): Response
    {
        return $this->render('project/show.html.twig', [
            'controller_name' => 'project',
            'project' => $project
        ]);
    }

    #[Route('/project/new', name: 'app_project_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/project/edit', name: 'app_project_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function new(?Project $project, Request $request, EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $project ??= new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $imgeFile = $form->get('image')->getData();

            if ($imgeFile) {
                $newFilename = uniqid() . '.' . $imgeFile->guessExtension();
                $imgeFile->move(
                    $this->getParameter('uploads_directory'), // Dossier de stockage
                    $newFilename
                );
                $project->setImage($newFilename); // Enregistre le chemin dans l'entité
            }



            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('app_project_show', ['id' => $project->getId()]);
        }
        return $this->render('project/new.html.twig', [
            'controller_name' => 'project',
            'form' => $form,
            'project' => $project
        ]);
    }


    #[Route('/{id}/project/supprimer', name: 'app_project_remove', requirements: ['id' => '\d+'],  methods: ['GET', 'POST'])]
    public function remove(?Project $project, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$project) {
            return $this->redirectToRoute('app_project');
        }

        $entityManager->remove($project);
        $entityManager->flush();

        return $this->redirectToRoute('app_project');
    }
}
