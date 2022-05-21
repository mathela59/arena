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
        $s->setText('##ATT## Simple attack');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('ATT');
        $s->setCritic(true);
        $s->setText('##ATT## Critical attack');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DEF');
        $s->setCritic(false);
        $s->setText('##DEF## Simple parry');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DEF');
        $s->setCritic(true);
        $s->setText('##DEF## Critical parry');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DOD');
        $s->setCritic(false);
        $s->setText('##DEF## Simple dodge');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DOD');
        $s->setCritic(true);
        $s->setText('##DEF## Critical Dodge');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('RIP');
        $s->setCritic(false);
        $s->setText('##DEF## Simple counter attack');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('RIP');
        $s->setCritic(true);
        $s->setText('##DEF## Critical counter attack');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('BEGIN');
        $s->setCritic(false);
        $s->setText('##ATT## ##DEF## beginning of the combat');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('END');
        $s->setCritic(false);
        $s->setText('end of the combat');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('VICTORY');
        $s->setCritic(false);
        $s->setText('##ATT## is victorious');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('DAMAGES');
        $s->setCritic(false);
        $s->setText('##ATT## inflicts damages to ##DEF##');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('AMBIANT');
        $s->setCritic(false);
        $s->setText('Random Ambient Sentence');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('AMBIANT_ATT');
        $s->setCritic(false);
        $s->setText('Random Attacking Ambient Sentence');
        $manager->persist($s);
        unset($s);

        $s = new Sentence();
        $s->setAction('AMBIANT_DEF');
        $s->setCritic(false);
        $s->setText('Random Defending Ambient Sentence');
        $manager->persist($s);
        unset($s);

        $manager->flush();
    }
}
