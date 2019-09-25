<?php

namespace App\DataFixtures;

use App\Entity\Sentences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SentencesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sentence = new Sentences();
        $sentence->setContent("#ATT# hit #DEF# with his weapon");
        $sentence->setAction("ATT");
        $sentence->setCritical("false");
        $manager->persist($sentence);

        $sentence = new Sentences();
        $sentence->setContent("#DEF# counter #ATT#");
        $sentence->setAction("CTR");
        $sentence->setCritical("false");
        $manager->persist($sentence);

        $sentence = new Sentences();
        $sentence->setContent("#DEF# dodge #ATT# attack");
        $sentence->setAction("ESQ");
        $sentence->setCritical("false");
        $manager->persist($sentence);

        $sentence = new Sentences();
        $sentence->setContent("#DEF# fight back #ATT# attack");
        $sentence->setAction("RIP");
        $sentence->setCritical("false");
        $manager->persist($sentence);

        $manager->flush();


    }
}
