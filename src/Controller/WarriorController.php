<?php

namespace App\Controller;

use App\Entity\Warrior;
use App\Form\WarriorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WarriorController extends AbstractController
{
    /**
     * @Route("/warrior/create", name="warrior_create")
     */
    public function index()
    {

        $wf = $this->createForm(WarriorType::class);

        return $this->render('warrior/index.html.twig', [
            'controller_name' => 'WarriorController',
            'warriorForm' => $wf->createView()
        ]);
    }

    /**
     * @Route("/warrior/handler", name="warrior_handler")
     */
    public function handle()
    {
        return "otot";
    }
}
