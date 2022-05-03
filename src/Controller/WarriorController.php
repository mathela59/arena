<?php

namespace App\Controller;

use App\Entity\Warrior;
use App\Form\WarriorType;
use App\Repository\WarriorRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/warrior')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[IsGranted('ROLE_ADMIN')]
class WarriorController extends AbstractController
{
    #[Route('/', name: 'app_warrior_index', methods: ['GET'])]
    public function index(WarriorRepository $warriorRepository): Response
    {
        return $this->render('warrior/index.html.twig', [
            'warriors' => $warriorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_warrior_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WarriorRepository $warriorRepository): Response
    {
        $warrior = new Warrior();
        $form = $this->createForm(WarriorType::class, $warrior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $warriorRepository->add($warrior);
            return $this->redirectToRoute('app_warrior_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warrior/new.html.twig', [
            'warrior' => $warrior,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_warrior_show', methods: ['GET'])]
    public function show(Warrior $warrior): Response
    {
        return $this->render('warrior/show.html.twig', [
            'warrior' => $warrior,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_warrior_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Warrior $warrior, WarriorRepository $warriorRepository): Response
    {
        $form = $this->createForm(WarriorType::class, $warrior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $warriorRepository->add($warrior);
            return $this->redirectToRoute('app_warrior_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warrior/edit.html.twig', [
            'warrior' => $warrior,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_warrior_delete', methods: ['POST'])]
    public function delete(Request $request, Warrior $warrior, WarriorRepository $warriorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$warrior->getId(), $request->request->get('_token'))) {
            $warriorRepository->remove($warrior);
        }

        return $this->redirectToRoute('app_warrior_index', [], Response::HTTP_SEE_OTHER);
    }
}
