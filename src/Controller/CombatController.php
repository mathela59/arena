<?php

namespace App\Controller;

use App\Repository\CombatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CombatController extends AbstractController
{
    #[Route('/combat/view/{id}', name: 'app_combat_view')]
    public function index(int $id, CombatRepository $combatRepository): Response
    {

        return $this->render('combat/viewCombat.html.twig', [
            'combat'=> $combatRepository->find($id),
            'controller_name' => 'CombatController',
        ]);
    }
}
