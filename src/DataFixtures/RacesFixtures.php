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

        $race = new Races();
        $race->setName("Human");
        $race->setDescription("Good for all purpose, Humans are well balanced");
        $race->setModifiers("");
        $manager->persist($race);

        $race = new Races();
        $race->setName("Elf");
        $race->setDescription("Elves are know for their speed and agility, not for their toughness");
        $race->setModifiers("");
        $manager->persist($race);

        $manager->flush();
    }
}
