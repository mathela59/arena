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
        $c->setMinimum(3);
        $c->setMaximum(18);
        $manager->persist($c);

        //CO
        $c = new Characteristic();
        $c->setName('Constitution');
        $c->setShortCode("CO");
        $c->setMinimum(3);
        $c->setMaximum(18);
        $manager->persist($c);

        //AG
        $c = new Characteristic();
        $c->setName('Dexterity');
        $c->setShortCode("AG");
        $c->setMinimum(3);
        $c->setMaximum(18);
        $manager->persist($c);

        //IN
        $c = new Characteristic();
        $c->setName('Intelligence');
        $c->setShortCode("IN");
        $c->setMinimum(3);
        $c->setMaximum(18);
        $manager->persist($c);

        //AC
        $c = new Characteristic();
        $c->setName('Armor');
        $c->setShortCode("AC");
        $c->setMinimum(3);
        $c->setMaximum(18);
        $manager->persist($c);

        //VI
        $c = new Characteristic();
        $c->setName('Speed');
        $c->setShortCode("VI");
        $c->setMinimum(3);
        $c->setMaximum(18);
        $manager->persist($c);

        $manager->flush();
    }
}
