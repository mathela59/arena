<?php

namespace App\Controller;

use App\Services\CombatListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CombatListController extends AbstractController
{
    #[Route('/combat/list/warrior/{id}', name: 'app_combat_list', methods:
['GET'])]
    public function index(int $id, CombatListService $Cls): Response
    {

        $list = $Cls->getWarriorCombatList($id);
        return $this->render('combat_list/index.html.twig', [
            'CombatList'=>$list,
            'controller_name' => 'CombatListController',
        ]);
    }
}
