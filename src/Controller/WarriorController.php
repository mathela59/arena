<?php

namespace App\Controller;

use App\Entity\Characteristic;
use App\Entity\Warrior;
use App\Entity\WarriorCharacteristic;
use App\Form\WarriorCharacteristicType;
use App\Form\WarriorType;
use App\Repository\CharacteristicRepository;
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
        if ($wf->isSubmitted() && $wf->isValid()) {
            $w = new Warrior();
            $data = $wf->getData();


            //Let's work around the characteristics of the warrior
            $c_repo = $this->getDoctrine()->getRepository(Characteristic::class);
            $c_list = $c_repo->findAll();

            foreach ($c_list as $c) {
                $car = new WarriorCharacteristic();
                $car->setCharacteristic($c);
                switch ($c->getName()) {
                    case 'Strengh':
                        $car->setValue($data->getStrengh()->getValue());
                        $w->setStrength($car);
                        break;
                    case
                    'Constitution':
                        $car->setValue($data->getConstitution()->getValue());
                        $w->setConstitution($car);
                        break;
                    case
                    'Dexterity':
                        $car->setValue($data->getDexterity()->getValue());
                        $w->setDexterity($car);
                        break;
                    case
                    'Speed':
                        $car->setValue($data->getSpeed()->getValue());
                        $w->setSpeed($car);
                        break;
                    case 'Armor':
                        $car->setValue($data->getArmor()->getValue());
                        $w->setArmor($car);
                        break;
                    case
                    'Intelligence':
                        $car->setValue($data->getIntelligence()->getValue());
                        $w->setIntelligence($car);
                        break;
                }
            }

            $this->get('session')->set('warrior', $w);
            return $this->redirectToRoute('warrior_create_2');
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

        dump($this->get('session')->get('warrior'));
        return $this->render('warrior/newWarriorStep2.html.twig', [
            'controller_name' => 'WarriorController',
        ]);
    }
}
