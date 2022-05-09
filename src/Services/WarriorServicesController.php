<?php

namespace App\Services;

use App\Entity\Warrior;


class WarriorServicesController
{
    public function modifyTraits(Warrior $warrior, $key, $value): Warrior
    {
        if ($key == 'STR')
            $warrior->setStrength($warrior->getStrength() + $value);

        if ($key == "SPE")
            $warrior->setSpeed($warrior->getSpeed() + $value);

        if ($key == "DEX")
            $warrior->setDexterity($warrior->getDexterity() + $value);

        if ($key == "CON")
            return $warrior->setConstitution($warrior->getConstitution() + $value);

        if ($key == "INT")
            $warrior->setIntelligence($warrior->getIntelligence() + $value);

        if ($key == "WIL")
            $warrior->setWill($warrior->getWill() + $value);


        return $warrior;
    }


    public function processStats(Warrior $warrior): Warrior
    {
        //Let's apply breedmodifiers
        $bm = $warrior->getBreed()->getModifiers();
        foreach ($bm as $key => $value) {
            $warrior = $this->modifyTraits($warrior,$key,$value);
        }

        //Let's apply fightStyleModifiers
        $fsm = $warrior->getFightStyle()->getModifiers();
        foreach($fsm as $key => $value)
        {
            $warrior = $this->modifyTraits($warrior,$key,$value);
        }

        //Let's apply SkillsModifiers
        //@TODO


        //Let's apply EquipmentModifiers
        $equipment = $warrior->getEquipment();
        foreach($equipment as $e) {
            $em = $e->getItem()->getModifiers();
            //@TODO => check if requirements are met
            foreach ($em as $key=>$value)
            {
                $warrior = $this->modifyTraits($warrior,$key, $value);
            }
        }

        return $warrior;
    }
}
