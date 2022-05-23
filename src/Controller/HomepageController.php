<?php

namespace App\Controller;

use App\Services\CoachServices;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'app_homepage')]
    #[IsGranted('ROLE_USER')]
    public function index(CoachServices $coachServices): Response
    {
        //get the warriors of a Coach
        $warriors = $coachServices->getCoachsWarriors($this->getUser());

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            "warriors"=>$warriors,
        ]);
    }
}
