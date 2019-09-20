<?php

namespace App\DataFixtures;

use App\Entity\Races;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RacesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $race = new Races();
        $race->setName("Dwarf");
        $race->setDescription("Little being, known for it's courage and toughness");
        $race->setModifiers("");

        $manager->persist($race);
        $manager->flush();
    }
}
