<?php

namespace App\Controller;

use App\Entity\Warrior;
use App\Service\WarriorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WarriorViewController extends AbstractController
{
    /**
     * @Route("/warrior/{id}", name="warrior_view")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(int $id)
    {
        $w = $this->getDoctrine()->getRepository(Warrior::class)->find($id);

        return $this->render('warrior_view/index.html.twig', [
            'controller_name' => 'WarriorViewController',
            'warrior'=>$w,
        ]);
    }


    /**
     * @param int $id
     * @Route("/warrior/{id}/heal", name="warrior_heal")
     */
    public function heal(int $id)
    {
        $WS = new WarriorService();
        $WS->HealWarrior($this->getDoctrine()->getRepository(Warrior::class)->find($id));


    }
}
