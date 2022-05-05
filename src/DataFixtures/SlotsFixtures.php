<?php

namespace App\DataFixtures;

use App\Entity\Slots;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SlotsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $s = new Slots();
        $s->setName('Left hand');
        $s->setDescription($s->getName());
        $this->addReference('slot_left_hand',$s);
        $manager->persist($s);
        unset($s);

        $s = new Slots();
        $s->setName('Right hand');
        $s->setDescription($s->getName());
        $this->addReference('slot_right_hand',$s);
        $manager->persist($s);
        unset($s);

        $s = new Slots();
        $s->setName('Head');
        $s->setDescription($s->getName());
        $this->addReference('slot_head',$s);
        $manager->persist($s);
        unset($s);

        $s = new Slots();
        $s->setName('Torso');
        $s->setDescription($s->getName());
        $this->addReference('slot_torso',$s);
        $manager->persist($s);
        unset($s);

        $s = new Slots();
        $s->setName('Left leg');
        $s->setDescription($s->getName());
        $this->addReference('slot_left_leg',$s);
        $manager->persist($s);
        unset($s);

        $s = new Slots();
        $s->setName('Right leg');
        $s->setDescription($s->getName());
        $this->addReference('slot_right_leg',$s);
        $manager->persist($s);
        unset($s);

        $manager->flush();
    }
}
