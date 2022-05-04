<?php

namespace App\Controller;

use App\Entity\Warrior;
use App\Form\WarriorCreationGlobalType;
use App\Form\WarriorOtherType;
use App\Form\WarriorRollType;
use App\Repository\WarriorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class WarriorCreationController extends AbstractController
{
    private $requestStack;
    private $encoders;
    private $normalizers;
    private $serializer;

    public function __construct(RequestStack $requestStack)
    {
        $this->encoders = [new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
        $this->requestStack = $requestStack;
    }

    public function hydrateWarriorFromSession(Warrior $warrior,Warrior $sessionWarrior)
    {
        if($warrior->getName()=='')
        {
            $warrior->setName($sessionWarrior->getName());
        }
        if($warrior->getDescription()=='')
        {
            $warrior->setDescription($sessionWarrior->getDescription());
        }
        if($warrior->getExperience()=='')
        {
            $warrior->setExperience($sessionWarrior->getExperience());
        }
        if($warrior->getStrength()=='' || $warrior->getStrength()==0)
        {
            $warrior->setStrength($sessionWarrior->getStrength());
        }
        if($warrior->getSpeed()=='' || $warrior->getSpeed()==0)
        {
            $warrior->setSpeed($sessionWarrior->getSpeed());
        }
        if($warrior->getDexterity()=='' || $warrior->getDexterity()==0)
        {
            $warrior->setDexterity($sessionWarrior->getDexterity());
        }
        if($warrior->getConstitution()=='' || $warrior->getConstitution()==0)
        {
            $warrior->setConstitution($sessionWarrior->getConstitution());
        }
        if($warrior->getIntelligence()=='' || $warrior->getIntelligence()==0)
        {
            $warrior->setIntelligence($sessionWarrior->getIntelligence());
        }
        if($warrior->getWill()=='' || $warrior->getWill()==0)
        {
            $warrior->setWill($sessionWarrior->getWill());
        }

        return $warrior;
    }

    #[Route('/warrior/creation', name: 'app_warrior_creation')]
    public function index(Request $request): Response
    {
        $warrior = new Warrior();
        $form = $this->createForm(WarriorCreationGlobalType::class, $warrior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $warrior->setName($form->getData()->getName());
            $warrior->setDescription($form->getData()->getDescription());

            //Initialize to 0 in order to enable deserialiszation
            $warrior->setSpeed(0);
            $warrior->setStrength(0);
            $warrior->setDexterity(0);
            $warrior->setConstitution(0);
            $warrior->setIntelligence(0);
            $warrior->setWill(0);

            $session = $this->requestStack->getSession();
            $session->set('currentWarrior', $this->serializer->serialize($warrior, 'json'));

            return $this->redirectToRoute('app_warrior_creation_roll', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warrior/new.html.twig', [
            'warrior' => $warrior,
            'form' => $form,
        ]);

        return $this->render('warrior_creation/index.html.twig', [
            'controller_name' => 'WarriorCreationController',
        ]);
    }

    #[Route('warrior/creation/roll', name: 'app_warrior_creation_roll')]
    public function roll(Request $request, WarriorRepository $warriorRepository): Response
    {
        $warrior = new Warrior();
        $form = $this->createForm(WarriorRollType::class, $warrior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $this->requestStack->getSession();
            $session_Warrior = $this->serializer->deserialize($session->get('currentWarrior'), Warrior::class, 'json');
            $warrior = $this->hydrateWarriorFromSession($warrior,$session_Warrior);
            $session->set('currentWarrior', $this->serializer->serialize($warrior, 'json'));
            return $this->redirectToRoute('app_warrior_breed_and_fight_style', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warrior/new.html.twig', [
            'warrior' => $warrior,
            'form' => $form,
        ]);

        return $this->render('warrior_creation/index.html.twig', [
            'controller_name' => 'WarriorCreationController',
        ]);
    }

    #[Route('warrior/creation/roll/other', name: 'app_warrior_breed_and_fight_style')]
    public function breedAndStyle(Request $request, WarriorRepository $warriorRepository): Response
    {
        $warrior = new Warrior();
        $form = $this->createForm(WarriorOtherType::class, $warrior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $session = $this->requestStack->getSession();
            $session_Warrior = $this->serializer->deserialize($session->get('currentWarrior'), Warrior::class, 'json');
            $warrior = $this->hydrateWarriorFromSession($warrior,$session_Warrior);
            $warrior->setCoach($this->getUser());
            $warriorRepository->add($warrior);

            $session->getFlashBag()->add('Success','Your warrior has been succesfully created');
            $session->set('currentWarrior',null);

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warrior/new.html.twig', [
            'warrior' => $warrior,
            'form' => $form,
        ]);

        return $this->render('warrior_creation/index.html.twig', [
            'controller_name' => 'WarriorCreationController',
        ]);
    }

}
