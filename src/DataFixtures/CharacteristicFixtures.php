<?php

namespace App\DataFixtures;

use App\Entity\Characteristic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CharacteristicFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //FO
        $c = new Characteristic();
        $c->setName('Strength');
        $c->setShortCode("FO");
        $manager->persist($c);

        //CO
        $c = new Characteristic();
        $c->setName('Constitution');
        $c->setShortCode("CO");
        $manager->persist($c);

        //AG
        $c = new Characteristic();
        $c->setName('Dexterity');
        $c->setShortCode("AG");
        $manager->persist($c);

        //IN
        $c = new Characteristic();
        $c->setName('Intelligence');
        $c->setShortCode("IN");
        $manager->persist($c);

        //AC
        $c = new Characteristic();
        $c->setName('Armor Class');
        $c->setShortCode("AC");
        $manager->persist($c);

        //VI
        $c = new Characteristic();
        $c->setName('Vivacity');
        $c->setShortCode("VI");
        $manager->persist($c);

        $manager->flush();
    }
}
