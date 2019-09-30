<?php

namespace App\Controller;

use App\Entity\Characteristic;
use App\Entity\Warrior;
use App\Entity\WarriorCharacteristic;
use App\Form\WarriorType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function newWarrior(EntityManagerInterface $em, Request $request)
    {

        $wf = $this->createForm(WarriorType::class);

        //Handle the form when submitted
        $wf->handleRequest($request);
        if ($wf->isSubmitted() && $wf->isValid()) {
            $w = new Warrior();
            /* @var Warrior */
            $data = $wf->getData();

            $w->setName($data->getName());
            $w->setFightingStyle($data->getFightingStyle());
            $w->setRace($data->getRace());
            $w->setVictories(0);
            $w->setDefeats(0);
            $w->setUser($this->getUser());


            //Let's work around the characteristics of the warrior
            $c_repo = $this->getDoctrine()->getRepository(Characteristic::class);
            $c_list = $c_repo->findAll();

            foreach ($c_list as $c) {
                $car = new WarriorCharacteristic();
                $car->setCharacteristic($c);
                switch ($c->getName()) {
                    case 'Strength':
                        $car->setValue($data->getStrength()->getValue());
                        $w->setStrength($car);
                        break;
                    case 'Constitution':
                        $car->setValue($data->getConstitution()->getValue());
                        $w->setConstitution($car);
                        break;
                    case 'Dexterity':
                        $car->setValue($data->getDexterity()->getValue());
                        $w->setDexterity($car);
                        break;
                    case 'Speed':
                        $car->setValue($data->getSpeed()->getValue());
                        $w->setSpeed($car);
                        break;
                    case 'Armor':
                        $car->setValue($data->getArmor()->getValue());
                        $w->setArmor($car);
                        break;
                    case 'Intelligence':
                        $car->setValue($data->getIntelligence()->getValue());
                        $w->setIntelligence($car);
                        break;
                }
                $em->persist($car);
            }
            $em->persist($w);
            $em->flush();
            dump($w);

        }

        if ($wf->isSubmitted() && !$wf->isValid()) {
            $this->addFlash('error', 'formulaire soumis invalide');
        }

        return $this->render('warrior/newWarrior.html.twig', [
            'controller_name' => 'WarriorController',
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
            'controller_name' => 'WarriorController',
        ]);
    }
}
