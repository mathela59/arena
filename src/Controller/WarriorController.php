<?php

namespace App\Controller;

use App\Entity\Warrior;
use App\Form\WarriorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class WarriorController extends AbstractController
{
    /**
     * @Route("/warrior/create", name="warrior_create")
     * @IsGranted("ROLE_USER")
     */
    public function newWarrior(Request $request)
    {

        $wf = $this->createForm(WarriorType::class);

        //Handle the form when submitted
        $wf->handleRequest($request);
        if($wf->isSubmitted() && $wf->isValid())
        {
            $w= new Warrior();
            $w=$wf->getData();
            $this->get('session')->set('warrior',$w);
            return $this->redirectToRoute('warrior_create_2');
        }

        if($wf->isSubmitted() && !$wf->isValid())
        {
            $this->addFlash('error','formulaire soumis invalide');
        }

        return $this->render('warrior/newWarrior.html.twig', [
            'controller_name' => 'WarriorController',
            'warriorForm' => $wf->createView()
        ]);
    }


    /**
     * @param Request $request
     * @Route("warrior/create-characteristics",name="warrior_create_2")
     * @isGranted("ROLE_USER")
     */
    public function newWarriorStep2(Request $request)
    {

        $wf = $this->createForm(WarriorCharacteristicsType::class);

        //Handle the form when submitted
        $wcf->handleRequest($request);
        if($wcf->isSubmitted() && $wcf->isValid())
        {
            $w= $this->get('sessions')->get('warrior');
            $w=$wf->getData();
            dump($w);
            $this->get('session')->set('warrior',$w);
            return $this->redirectToRoute('warrior_create_2');
        }

        if($wf->isSubmitted() && !$wf->isValid())
        {
            $this->addFlash('error','formulaire soumis invalide');
        }


        return $this->render('warrior/newWarriorStep2.html.twig', [
            'controller_name' => 'WarriorController',
            'warriorForm' => $wf->createView()
        ]);
    }
}
