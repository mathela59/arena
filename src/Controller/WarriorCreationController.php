<?php

namespace App\Controller;

use App\Entity\Characteristic;
use App\Entity\Warrior;
use App\Entity\WarriorCharacteristic;
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

            //Now we can access the warrior Id so we can process characteristics
            foreach ($list as $carac) {
                $wc = new WarriorCharacteristic();
                $wc->setCharacteristic($carac);
                $wc->setWarrior($w);
                $wc->setValue($data[$carac->getName()]);
                $em->persist($wc);
            }
            $em->flush();

            $this->redirectToRoute('homepage');

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
     * @Route("warrior/create-characteristics",name="warrior_create_2")
     * @isGranted("ROLE_USER")
     */
    public
    function newWarriorStep2(Request $request)
    {

        $w_repo = $this->getDoctrine()->getRepository(Warrior::class);
        $w_list = $w_repo->findAll();


        dump($this->get('session')->get('warrior'));
        return $this->render('warrior/newWarriorStep2.html.twig', [
            'controller_name' => 'WarriorCreationController',
        ]);
    }
}
