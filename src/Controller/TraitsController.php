<?php

namespace App\Controller;

use App\Entity\Traits;
use App\Form\TraitsType;
use App\Repository\TraitsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/traits')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[IsGranted('ROLE_ADMIN')]
class TraitsController extends AbstractController
{
    #[Route('/', name: 'app_traits_index', methods: ['GET'])]
    public function index(TraitsRepository $traitsRepository): Response
    {
        return $this->render('traits/index.html.twig', [
            'traits' => $traitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_traits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TraitsRepository $traitsRepository): Response
    {
        $trait = new Traits();
        $form = $this->createForm(TraitsType::class, $trait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $traitsRepository->add($trait);
            return $this->redirectToRoute('app_traits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('traits/new.html.twig', [
            'trait' => $trait,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traits_show', methods: ['GET'])]
    public function show(Traits $trait): Response
    {
        return $this->render('traits/show.html.twig', [
            'trait' => $trait,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_traits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Traits $trait, TraitsRepository $traitsRepository): Response
    {
        $form = $this->createForm(TraitsType::class, $trait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $traitsRepository->add($trait);
            return $this->redirectToRoute('app_traits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('traits/edit.html.twig', [
            'trait' => $trait,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traits_delete', methods: ['POST'])]
    public function delete(Request $request, Traits $trait, TraitsRepository $traitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trait->getId(), $request->request->get('_token'))) {
            $traitsRepository->remove($trait);
        }

        return $this->redirectToRoute('app_traits_index', [], Response::HTTP_SEE_OTHER);
    }
}
