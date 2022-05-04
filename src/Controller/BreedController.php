<?php

namespace App\Controller;

use App\Entity\Breed;
use App\Form\BreedType;
use App\Repository\BreedRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/breed')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[IsGranted('ROLE_ADMIN')]
class BreedController extends AbstractController
{
    #[Route('/', name: 'app_breed_index', methods: ['GET'])]
    public function index(BreedRepository $breedRepository): Response
    {
        return $this->render('breed/index.html.twig', [
            'breeds' => $breedRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_breed_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BreedRepository $breedRepository): Response
    {
        $breed = new Breed();
        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stats = json_decode($form->get('modifiers')->getViewData(),true);
            $breed->setModifiers($stats);
            $breedRepository->add($breed);
            return $this->redirectToRoute('app_breed_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('breed/new.html.twig', [
            'breed' => $breed,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_breed_show', methods: ['GET'])]
    public function show(Breed $breed): Response
    {
        return $this->render('breed/show.html.twig', [
            'breed' => $breed,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_breed_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Breed $breed, BreedRepository $breedRepository): Response
    {
        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stats = json_decode($form->get('modifiers')->getViewData(),true);
            $breed->setModifiers($stats);
            $breedRepository->add($breed);
            return $this->redirectToRoute('app_breed_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('breed/edit.html.twig', [
            'breed' => $breed,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_breed_delete', methods: ['POST'])]
    public function delete(Request $request, Breed $breed, BreedRepository $breedRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$breed->getId(), $request->request->get('_token'))) {
            $breedRepository->remove($breed);
        }

        return $this->redirectToRoute('app_breed_index', [], Response::HTTP_SEE_OTHER);
    }
}
