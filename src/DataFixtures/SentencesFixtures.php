<?php

namespace App\DataFixtures;

use App\Entity\Sentence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SentencesFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     * @codeCoverageIgnore
     */
    public function load(ObjectManager $manager): void
    {
        $s = new Sentence();
        $s->setAction('ATT');
        $s->setCritic(false);
        $s->setText('Simple attack');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('ATT');
        $s->setCritic(true);
        $s->setText('Critical attack');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DEF');
        $s->setCritic(false);
        $s->setText('Simple parry');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DEF');
        $s->setCritic(true);
        $s->setText('Critical parry');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DOD');
        $s->setCritic(false);
        $s->setText('Simple dodge');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DOD');
        $s->setCritic(true);
        $s->setText('Critical Dodge');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('RIP');
        $s->setCritic(false);
        $s->setText('Simple counter attack');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('RIP');
        $s->setCritic(true);
        $s->setText('Critical counter attack');
        $manager->persist($s);
        unset($s);




        $manager->flush();
    }
}
