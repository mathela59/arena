<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BreedFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     * @return void
     * @codeCoverageIgnore
     */
    public function load(ObjectManager $manager): void
    {
        $b =  new Breed();
        $b->setName("Human");
        $b->setDescription("Simply human");
        $b->setModifiers([]);
        $manager->persist($b);

        $b =  new Breed();
        $b->setName("Dwarf");
        $b->setDescription("Dwarves");
        $b->setModifiers(["CON"=>3,"SPE"=>-2]);
        $manager->persist($b);

        $manager->flush();
    }
}
