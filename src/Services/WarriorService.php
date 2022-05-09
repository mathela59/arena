<?php

namespace App\Services;

use App\Entity\Warrior;


class WarriorService
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
            $warrior->setConstitution($warrior->getConstitution() + $value);

        if ($key == "INT")
            $warrior->setIntelligence($warrior->getIntelligence() + $value);

        if ($key == "WIL")
            $warrior->setWill($warrior->getWill() + $value);


        return $warrior;
    }


    /**
     * return the value of a stat using his shortcode(trigram)
     * @param Warrior $warrior
     * @param string $key
     * @return int|null
     */
    public function getChar(Warrior $warrior, string $key): ?int
    {
        if ($key == 'STR')
            return $warrior->getStrength();

        if ($key == "SPE")
            return $warrior->getSpeed();

        if ($key == "DEX")
            return $warrior->getDexterity();

        if ($key == "CON")
            return $warrior->getConstitution();

        if ($key == "INT")
            return $warrior->getIntelligence();

        if ($key == "WIL")
            return $warrior->getWill();

        return null;
    }


    /**
     * return a warrior with his stats modified by modifiers and requirements
     * @param Warrior $warrior
     * @return Warrior
     */
    public function processStats(Warrior $warrior): Warrior
    {
        //Let's apply Breed modifiers - First
        $bm = $warrior->getBreed()->getModifiers();
        foreach ($bm as $key => $value) {
            $warrior = $this->modifyTraits($warrior, $key, $value);
        }

        //Let's apply SkillsModifiers - Second
        $skills = $warrior->getSkills();
        foreach($skills as $skill)
        {
            $sm = $skill->getModifiers();
            foreach($sm as $key=>$value)
            {
                $warrior = $this->modifyTraits($warrior,$key,$value);
            }
        }

        //Let's apply fightStyleModifiers - Third
        $fsm = $warrior->getFightStyle()->getModifiers();
        foreach ($fsm as $key => $value) {
            $warrior = $this->modifyTraits($warrior, $key, $value);
        }

        //Let's apply EquipmentModifiers - Fourth
        $equipment = $warrior->getEquipment();
        foreach ($equipment as $e) {
            $em = $e->getItem()->getModifiers();
            $er = $e->getItem()->getRequirements();
            $canUseItem = true;
            foreach ($er as $key => $value) {
                if ($this->getChar($warrior, $key) < $value) {
                    $canUseItem = false;
                }
            }

            foreach ($em as $key => $value) {
                if ($canUseItem === true) $warrior = $this->modifyTraits($warrior, $key, $value);
            }
        }

        return $warrior;
    }
}
