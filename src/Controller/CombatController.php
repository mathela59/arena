<?php

namespace App\Controller;

use App\Repository\CombatRepository;
use App\Repository\WarriorRepository;
use App\Services\CombatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CombatController extends AbstractController
{
    #[Route('/combat/view/{id}', name: 'app_combat_view')]
    public function index(int $id, CombatRepository $combatRepository,RequestStack $rs):
    Response
    {

        return $this->render('combat/viewCombat.html.twig', [
            'combat'=> $combatRepository->find($id),
            'controller_name' => 'CombatController',
            'sourceWarriorId'=> $rs->getSession()->get('warrior')
        ]);
    }

    #[Route('/combat/random_fight', name:'app_combat_random')]
    public function randomFight(WarriorRepository $warriorRepository,
                                CombatService $combatService, RequestStack $rs)
    {
        $opponent1 = $warriorRepository->findOneRandomWarrior();
        $opponent2 =  $warriorRepository->findOneRandomWarriorExceptThisOne
        ($opponent1->getId());

        $combatService->initCombat($opponent1,$opponent2);
        $combatService->generateCombat(false);

        return $this->render('combat/viewCombat.html.twig', [
            'combat'=> $combatService->getCombat(),
            'sourceWarriorId'=> $rs->getSession()->get('warrior')
        ]);


    }
}
