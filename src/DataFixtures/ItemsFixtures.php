<?php

namespace App\DataFixtures;

use App\Entity\Items;
use App\Repository\SlotsRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemsFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @return string[]
     * @codeCoverageIgnore
     */
    public function getDependencies()
    {
        return [
            SlotsFixtures::class,
        ];
    }

    /**
     * @param ObjectManager $manager
     * @return void
     * @codeCoverageIgnore
     */
    public function load(ObjectManager $manager): void
    {

        $i = new Items();
        $i->setName('Small Shield');
        $i->setDescription($i->getName());
        $i->setModifiers(["CON" => 1, "SPE" => -1]);
        $i->setRequirements(["INT" => 10]);
        $i->setSlot($this->getReference('slot_left_hand'));
        $manager->persist($i);
        unset($i);

        $i = new Items();
        $i->setName('Large Shield');
        $i->setDescription($i->getName());
        $i->setModifiers(["CON" => 3, "SPE" => -2, "DEX" => -2]);
        $i->setRequirements(["INT" => 10]);
        $i->setSlot($this->getReference('slot_left_hand'));
        $manager->persist($i);
        unset($i);

        $i = new Items();
        $i->setName('Short Sword');
        $i->setDescription($i->getName());
        $i->setModifiers(["STR" => 1, "SPE" => 1]);
        $i->setRequirements(["DEX" => 5]);
        $i->setSlot($this->getReference('slot_right_hand'));
        $manager->persist($i);
        unset($i);

        $manager->flush();
    }
}
