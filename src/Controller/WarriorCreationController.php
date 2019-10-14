<?php

namespace App\Controller;

use App\Entity\Characteristic;
use App\Entity\Warrior;
use App\Entity\WarriorCharacteristic;
use App\Form\WarriorCharacteristicType;
use App\Form\WarriorCreationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class WarriorCreationController extends AbstractController
{
    /**
     * @Route("/warrior/create", name="warrior_create")
     * @IsGranted("ROLE_USER")
     */
    public function newWarrior(EntityManagerInterface $em, Request $request)
    {

        $wf = $this->createForm(WarriorCreationType::class);


        //Handle the form when submitted
        $wf->handleRequest($request);
        if ($wf->isSubmitted() && $wf->isValid()) {

            $c_repo = $em->getRepository(Characteristic::class);
            $list = $c_repo->findAll();

            $data = $wf->getData();

            //As my form is a custom, need to affect the good Values
            $w = new Warrior();
            $w->setName($data['Name']);
            $w->setFightingStyle($data['FightingStyle']);
            $w->setRace($data['Race']);
            $w->setVictories(0);
            $w->setDefeats(0);
            $w->setUser($this->getUser());
            $w->setLife(0);
            $w->setExperience(0);
            $em->persist($w);
            $em->flush();

//            //Now we can access the warrior Id so we can process characteristics
//            foreach ($list as $carac) {
//                $wc = new WarriorCharacteristic();
//                $wc->setCharacteristic($carac);
//                $wc->setWarrior($w);
//                $wc->setValue($data[$carac->getName()]);
//                $em->persist($wc);
//            }
//            $em->flush();
            //$this->redirectTo('warrior_creation_step2',["warrior_current"=>$w]);
            return $this->redirectToRoute("warrior_creation_step2",["warrior_current"=>$w], 302);

        }

        if ($wf->isSubmitted() && !$wf->isValid()) {
            $this->addFlash('error', 'formulaire soumis invalide');
        }

        return $this->render('warrior/newWarrior.html.twig', [
            'controller_name' => 'WarriorCreationController',
            'warriorForm' => $wf->createView()
        ]);
    }



    /**
     * @Route("warrior/create-characteristics",name="warrior_creation_step2")
     * @isGranted("ROLE_USER")
     */
    public
    function newWarriorStep2(EntityManagerInterface $em, Request $request)
    {
        //First we gather informations from the newly created Warrior
        $w = $request->get('warrior');

        //then we create the formCaracteristics.
        $wc_form = $this->createForm(WarriorCharacteristicType::class);

        //Handle the form when submitted
        $wc_form->handleRequest($request);
        if ($wc_form->isSubmitted() && $wc_form->isValid()) {

            $c_repo = $em->getRepository(Characteristic::class);
            $list = $c_repo->findAll();

            $data = $wc_form->getData();

            dump($data);
            die("characteristics form submitted");
            //return $this->redirectToRoute("warrior_creation_step3",["warrior_current"=>$w], 302);

        }

        if ($wf->isSubmitted() && !$wf->isValid()) {
            $this->addFlash('error', 'formulaire soumis invalide');
        }


        return $this->render('warrior/newWarriorStep2.html.twig', [
            'controller_name' => 'WarriorCreationController',
            'warriorForm' => $wc_form->createView(),
            'warrior' => $w,
        ]);
    }

    /**
     * @Route ("warrior/saveCharacteristics","warrior_creation_step3")
     *
     */
    public function newWarriorStep3(Request $request)
    {
        $w = $request->get('warrior_current');

        $this->addFlash('success', 'Welcome to your new Warrior !!');

        return $this->redirectToRoute("warrior_view",["id"=>$w->getId()],302);
    }

}
