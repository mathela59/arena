<?php

namespace App\Service;

use App\Entity\Warrior;
use Doctrine\ORM\EntityManagerInterface;

class WarriorService
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em= $entityManager;
    }

    public function HealWarrior(Warrior $w)
    {

        die("access to Service");
        $w->setLife(100);

        $this->em->persist($w);
        $this->em->flush();

        return $this->redirectToRoute('warrior_view',array('id'=>(int)$w->getId()));

    }

}
