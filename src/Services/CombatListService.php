<?php

namespace App\Services;

use App\Repository\CombatRepository;
use App\Repository\WarriorRepository;
use Doctrine\Common\Collections\ArrayCollection;

class CombatListService
{

    private $warriorRepository;
    private $combatRepository;

    public function __construct(WarriorRepository $wr,
                                CombatRepository $cr)
    {
        $this->warriorRepository=$wr;
        $this->combatRepository=$cr;

    }

    public function getWarriorCombatList(int $warriorId)
    {
        $warrior = $this->warriorRepository->find($warriorId);
        $combats = $warrior->getCombats();
        $combatsExtra = $warrior->getCombatsExtra();
        return array_merge($combats->toArray(),$combatsExtra->toArray());
    }




}