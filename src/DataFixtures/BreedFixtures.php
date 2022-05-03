<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BreedFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $b =  new Breed();
        $b->setName("Human");
        $b->setDescription("Simply human");
        $b->setModifiers(null);
        $manager->persist($b);

        $manager->flush();
    }
}
