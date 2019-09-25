<?php

namespace App\DataFixtures;

use App\Entity\FightingStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FigthingStyleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fs = new FightingStyle();
        $fs->setName("Generic");
        $fs->setModifiers("");
        $manager->persist($fs);
        $manager->flush();
    }
}
