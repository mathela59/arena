<?php

namespace App\Tests\Unit\Services;

use App\Entity\Breed;
use App\Entity\Equipment;
use App\Entity\FightStyle;
use App\Entity\Items;
use App\Entity\Skills;
use App\Entity\Slots;
use App\Entity\Warrior;
use App\Services\WarriorService;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Services\WarriorService
 */
class WarriorServicesTest extends TestCase
{

    /**
     * @covers \App\Services\WarriorService::processStats
     * @covers \App\Services\WarriorService::modifyTraits
     * @covers \App\Services\WarriorService::getChar
     * @return void
     */
    public function testItShouldCalculateModifiedTraits(): void
    {
        //Complete definition of a warrior
        $slot = new Slots();
        $slot->setName('slotTest');
        $slot->setDescription('slotTest');


        $item = new Items();
        $item->setSlot($slot);
        $item->setDescription('ItemTest');
        $item->setName('ItemTest');
        $item->setModifiers(["INT" => 10, "STR" => -10]);
        $item->setRequirements(["DEX" => 15]);

        $breed = new Breed();
        $breed->setModifiers(["SPE" => 15]);
        $breed->setName("breedTest");

        $f = new FightStyle();
        $f->setName('FightStyleTest');
        $f->setModifiers(["CON" => 10]);

        $e = new Equipment();
        $e->setSlot($slot);
        $e->setItem($item);

        $w = new Warrior();
        $w->setName("WarriorTest");
        $w->setWill(10);
        $w->setIntelligence(10);
        $w->setConstitution(10);
        $w->setDexterity(15);
        $w->setSpeed(10);
        $w->setStrength(10);
        $w->setBreed($breed);
        $w->setFightStyle($f);
        $w->addEquipment($e);

        $ws = new WarriorService();
        $ws->processStats($w);

        //Brings a collection of tests using modifiers
        $this->assertEquals($w->getWill(), 10);
        $this->assertEquals($w->getIntelligence(), 20);
        $this->assertEquals($w->getConstitution(), 20);
        $this->assertEquals($w->getDexterity(), 15);
        $this->assertEquals($w->getSpeed(), 25);
        $this->assertEquals($w->getStrength(), 0);

        $item2 = new Items();
        $item2->setSlot($slot);
        $item2->setModifiers(["WIL" => 5, "STR" => "18"]);


        $e2 = new Equipment();
        $e2->setItem($item2);
        $e2->setSlot($slot);

        $w->addEquipment($e2);

        $ws->processStats($w);
        $this->assertEquals($w->getWill(), 15);
        $this->assertEquals($w->getStrength(), 8);
    }

    /**
     * @covers \App\Services\WarriorService::processStats
     * @covers \App\Services\WarriorService::modifyTraits
     * @covers \App\Services\WarriorService::getChar
     * @return void
     */
    public function testItShouldCalculateModifiedTraitsWithUnmetEquipmentRequirement(): void
    {
        //Complete definition of a warrior
        $slot = new Slots();
        $slot->setName('slotTest');
        $slot->setDescription('slotTest');

        $item = new Items();
        $item->setSlot($slot);
        $item->setDescription('ItemTest');
        $item->setName('ItemTest');
        $item->setModifiers(["INT" => 5, "STR" => -5]);
        $item->setRequirements(["DEX" => 15,"INT"=>10, "CON"=>10, "STR"=>5, "SPE"=>5, "WIL"=>5]);

        $e = new Equipment();
        $e->setSlot($slot);
        $e->setItem($item);

        $breed = new Breed();
        $breed->setModifiers([]);
        $breed->setName("breedTest");

        $f = new FightStyle();
        $f->setName('FightStyleTest');
        $f->setModifiers([]);

        $w = new Warrior();
        $w->setName("WarriorTest");
        $w->setWill(10);
        $w->setIntelligence(10);
        $w->setConstitution(10);
        $w->setDexterity(10);
        $w->setSpeed(10);
        $w->setStrength(10);
        $w->setBreed($breed);
        $w->setFightStyle($f);
        $w->addEquipment($e);

        $ws = new WarriorService();
        $ws->processStats($w);

//        dump($w);
        //Brings a collection of tests using modifiers

        $this->assertEquals($w->getIntelligence(), 10);
        $this->assertEquals($w->getStrength(), 10);
    }


    /**
     * @covers \App\Services\WarriorService::getChar
     * @return void
     */
    public function testItShouldReturnNull(): void
    {

        $breed = new Breed();
        $breed->setModifiers([]);
        $breed->setName("breedTest");

        $f = new FightStyle();
        $f->setName('FightStyleTest');
        $f->setModifiers([]);

        $w = new Warrior();
        $w->setName("WarriorTest");
        $w->setWill(10);
        $w->setIntelligence(10);
        $w->setConstitution(10);
        $w->setDexterity(10);
        $w->setSpeed(10);
        $w->setStrength(10);
        $w->setBreed($breed);
        $w->setFightStyle($f);



        $ws = new WarriorService();
        $ws->processStats($w);

        $this->assertNull($ws->getChar($w,"TOT"));

    }

    public function testSkills(): void
    {
        $skill = new Skills();
        $skill->setModifiers(["INT"=>2,"DEX"=>2]);
        $breed = new Breed();
        $breed->setModifiers([]);
        $breed->setName("breedTest");

        $f = new FightStyle();
        $f->setName('FightStyleTest');
        $f->setModifiers([]);

        $w = new Warrior();
        $w->setName("WarriorTest");
        $w->setWill(10);
        $w->setIntelligence(10);
        $w->setConstitution(10);
        $w->setDexterity(10);
        $w->setSpeed(10);
        $w->setStrength(10);
        $w->addSkill($skill);
        $w->setBreed($breed);
        $w->setFightStyle($f);


        $ws = new WarriorService();
        $ws->processStats($w);

        $this->assertEquals($w->getIntelligence(),12);

    }
}
