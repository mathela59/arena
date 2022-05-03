<?php

namespace App\Controller;

use App\Entity\FightStyle;
use App\Form\FightStyleType;
use App\Repository\FightStyleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/fight/style')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[IsGranted('ROLE_ADMIN')]
class FightStyleController extends AbstractController
{
    #[Route('/', name: 'app_fight_style_index', methods: ['GET'])]
    public function index(FightStyleRepository $fightStyleRepository): Response
    {
        return $this->render('fight_style/index.html.twig', [
            'fight_styles' => $fightStyleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fight_style_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FightStyleRepository $fightStyleRepository): Response
    {
        $fightStyle = new FightStyle();
        $form = $this->createForm(FightStyleType::class, $fightStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stats = json_decode($form->get('modifiers')->getViewData(),true);
            $fightStyle->setModifiers($stats);
            $fightStyleRepository->add($fightStyle);
            return $this->redirectToRoute('app_fight_style_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fight_style/new.html.twig', [
            'fight_style' => $fightStyle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fight_style_show', methods: ['GET'])]
    public function show(FightStyle $fightStyle): Response
    {
        return $this->render('fight_style/show.html.twig', [
            'fight_style' => $fightStyle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fight_style_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FightStyle $fightStyle, FightStyleRepository $fightStyleRepository): Response
    {
        $form = $this->createForm(FightStyleType::class, $fightStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stats = json_decode($form->get('modifiers')->getViewData(),true);
            $fightStyle->setModifiers($stats);
            $fightStyleRepository->add($fightStyle);
            return $this->redirectToRoute('app_fight_style_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fight_style/edit.html.twig', [
            'fight_style' => $fightStyle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fight_style_delete', methods: ['POST'])]
    public function delete(Request $request, FightStyle $fightStyle, FightStyleRepository $fightStyleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fightStyle->getId(), $request->request->get('_token'))) {
            $fightStyleRepository->remove($fightStyle);
        }

        return $this->redirectToRoute('app_fight_style_index', [], Response::HTTP_SEE_OTHER);
    }
}
