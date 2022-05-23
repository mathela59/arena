<?php

namespace App\Services;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CoachServices
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getCoachsWarriors(User $user)
    {
        return $user->getWarriors();

    }
}