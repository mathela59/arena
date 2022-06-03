<?php

namespace App\Services;

use App\Repository\CombatRepository;
use App\Repository\WarriorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RequestStack;

class CombatListService
{

    private $warriorRepository;
    private $combatRepository;
    private $session;

    public function __construct(WarriorRepository $wr,
                                CombatRepository $cr, RequestStack $rs)
    {
        $this->warriorRepository=$wr;
        $this->combatRepository=$cr;
        $this->session =$rs->getSession();
    }

    public function getWarriorCombatList(int $warriorId)
    {
        $warrior = $this->warriorRepository->find($warriorId);
        $combats = $warrior->getCombats();
        $combatsExtra = $warrior->getCombatsExtra();
        $this->session->set('warrior',$warriorId);
        return array_merge($combats->toArray(),$combatsExtra->toArray());
    }




}