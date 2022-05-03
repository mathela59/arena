<?php

namespace App\Controller;

use App\Entity\Sentence;
use App\Form\SentenceType;
use App\Repository\SentenceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/sentence')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[IsGranted('ROLE_ADMIN')]
class SentenceController extends AbstractController
{
    #[Route('/', name: 'app_sentence_index', methods: ['GET'])]
    public function index(SentenceRepository $sentenceRepository): Response
    {
        return $this->render('sentence/index.html.twig', [
            'sentences' => $sentenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sentence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SentenceRepository $sentenceRepository): Response
    {
        $sentence = new Sentence();
        $form = $this->createForm(SentenceType::class, $sentence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sentenceRepository->add($sentence);
            return $this->redirectToRoute('app_sentence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sentence/new.html.twig', [
            'sentence' => $sentence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sentence_show', methods: ['GET'])]
    public function show(Sentence $sentence): Response
    {
        return $this->render('sentence/show.html.twig', [
            'sentence' => $sentence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sentence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sentence $sentence, SentenceRepository $sentenceRepository): Response
    {
        $form = $this->createForm(SentenceType::class, $sentence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sentenceRepository->add($sentence);
            return $this->redirectToRoute('app_sentence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sentence/edit.html.twig', [
            'sentence' => $sentence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sentence_delete', methods: ['POST'])]
    public function delete(Request $request, Sentence $sentence, SentenceRepository $sentenceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sentence->getId(), $request->request->get('_token'))) {
            $sentenceRepository->remove($sentence);
        }

        return $this->redirectToRoute('app_sentence_index', [], Response::HTTP_SEE_OTHER);
    }
}
