<?php

namespace App\DataFixtures;

use App\Entity\Traits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TraitsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $trait = new Traits();
        $trait->setName("STRENGTH");
        $trait->setDescription("Strengh is directly linked to the damages you can do, the type of armor you wear, ...");
        $trait->setShortCode("STR");
        $manager->persist($trait);
        unset($trait);

        $trait = new Traits();
        $trait->setName("SPEED");
        $trait->setDescription("Speed drives the way you fight, the ability to take initiative, ...");
        $trait->setShortCode("SPE");
        $manager->persist($trait);
        unset($trait);

        $trait = new Traits();
        $trait->setName("DEXTERITY");
        $trait->setDescription("Dexterity is required to manipulate weapons, dodge, parry, attack, ...");
        $trait->setShortCode("DEX");
        $manager->persist($trait);
        unset($trait);

        $trait = new Traits();
        $trait->setName("CONSTITUTION");
        $trait->setDescription("Stamina, damages before being Ko, etc ..");
        $trait->setShortCode("CON");
        $manager->persist($trait);
        unset($trait);

        $trait = new Traits();
        $trait->setName("INTELLIGENCE");
        $trait->setDescription("Intelligence is mandatory to learn from your mistakes !!");
        $trait->setShortCode("INT");
        $manager->persist($trait);
        unset($trait);

        $trait = new Traits();
        $trait->setName("WILL");
        $trait->setDescription("force of Will determine how you react facing the defeat or death ..");
        $trait->setShortCode("WIL");
        $manager->persist($trait);
        unset($trait);

        $manager->flush();
    }
}
