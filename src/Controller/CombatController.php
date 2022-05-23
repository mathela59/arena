<?php

namespace App\Controller;

use App\Repository\WarriorRepository;
use App\Services\CombatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CombatController extends AbstractController
{
    #[Route('/combat/random', name: 'app_combat_random')]
    public function index(CombatService $combatService, WarriorRepository $warriorRepository):
    Response
    {
        $opponent1 = $warriorRepository->findOneRandomWarrior();
        $opponent2 = $warriorRepository->findOneRandomWarriorExceptThisOne
        ($opponent1->getId());

        $combatService->initCombat($opponent1,$opponent2);
        $combatService->generateCombat();


        return $this->render('combat/index.html.twig', [
            'controller_name' => 'CombatController',
            'combat'=>$combatService->getCombat()
        ]);
    }
}
