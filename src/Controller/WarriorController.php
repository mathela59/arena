<?php

namespace App\Controller;

use App\Entity\Warrior;
use App\Form\WarriorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WarriorController extends AbstractController
{
    /**
     * @Route("/warrior/create", name="warrior_create")
     */
    public function newWarrior(Request $request)
    {

        $wf = $this->createForm(WarriorType::class);

        //Handle the form when submitted
        $wf->handleRequest($request);
        if($wf->isSubmitted() && $wf->isValid())
        {
            //Handle the data and then persists Objects
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            //$task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );

            //handling data is over => redirect to prevent multiple submissions
            //return $this->redirectToRoute('homepage');
        }

        return $this->render('warrior/newWarrior.html.twig', [
            'controller_name' => 'WarriorController',
            'warriorForm' => $wf->createView()
        ]);
    }
}
