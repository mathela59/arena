<?php

namespace App\Controller;

use App\Entity\Slots;
use App\Form\SlotsType;
use App\Repository\SlotsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/slots')]
class SlotsController extends AbstractController
{
    #[Route('/', name: 'app_slots_index', methods: ['GET'])]
    public function index(SlotsRepository $slotsRepository): Response
    {
        return $this->render('slots/index.html.twig', [
            'slots' => $slotsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_slots_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SlotsRepository $slotsRepository): Response
    {
        $slot = new Slots();
        $form = $this->createForm(SlotsType::class, $slot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slotsRepository->add($slot);
            return $this->redirectToRoute('app_slots_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('slots/new.html.twig', [
            'slot' => $slot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_slots_show', methods: ['GET'])]
    public function show(Slots $slot): Response
    {
        return $this->render('slots/show.html.twig', [
            'slot' => $slot,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_slots_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Slots $slot, SlotsRepository $slotsRepository): Response
    {
        $form = $this->createForm(SlotsType::class, $slot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slotsRepository->add($slot);
            return $this->redirectToRoute('app_slots_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('slots/edit.html.twig', [
            'slot' => $slot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_slots_delete', methods: ['POST'])]
    public function delete(Request $request, Slots $slot, SlotsRepository $slotsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$slot->getId(), $request->request->get('_token'))) {
            $slotsRepository->remove($slot);
        }

        return $this->redirectToRoute('app_slots_index', [], Response::HTTP_SEE_OTHER);
    }
}
