<?php

namespace App\DataFixtures;

use App\Entity\FightStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FightStyleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $f = new FightStyle();
        $f->setName('Tank');
        $f->setDescription('Tank is able to deal with a huge amount of damages');
        $f->setModifiers(json_decode('{"CON":3,"WIL":3}',true));
        $manager->persist($f);
        unset($f);

        $f = new FightStyle();
        $f->setName('Javelin');
        $f->setDescription('a Javelin is a dedaly precise warrior, waiting for the good opportunity to inflicts maximum damages');
        $f->setModifiers(json_decode('{"CON":3,"WIL":3}',true));
        $manager->persist($f);
        unset($f);

        $f = new FightStyle();
        $f->setName('Defender');
        $f->setDescription('Defender uses his weapons to parry the attacks, When his opponent is tired, he attack him');
        $f->setModifiers(json_decode('{"CON":3,"WIL":3}',true));
        $manager->persist($f);
        unset($f);

        $f = new FightStyle();
        $f->setName('Berserk');
        $f->setDescription('Berserk doesn\'t pay attention of his body, his only word is : Attaacckk !!' );
        $f->setModifiers(json_decode('{"CON":3,"WIL":3}',true));
        $manager->persist($f);
        unset($f);

        $manager->flush();
    }
}
