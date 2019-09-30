<?php

namespace App\Controller;

use App\Entity\Warrior;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomepageController extends AbstractController
{
	/**
	 * @Route("/", name="homepage")
     * @IsGranted("ROLE_USER")
	 */
	public function homepage()
	{
	    $repos = $this->getDoctrine()->getRepository(Warrior::class);

	    $warriors = $repos->findBy(["User"=>$this->getUser()->getId()]);

		return $this->render('homepage/index.html.twig',['warriors'=>$warriors]);


	}
}
