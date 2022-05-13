<?php

namespace App\Services;

use App\Entity\Combat;
use App\Entity\Warrior;
use Container3uoFGkY\getCache_ValidatorExpressionLanguageService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;

class CombatService
{
    private Warrior $opponent1;
    private Warrior $opponent2;
    private array $ratios1;
    private array $ratios2;
    private array $damages;

    public function __construct(Warrior $opponent1, Warrior $opponent2)
    {
        $this->opponent1 = $opponent1;
        $this->opponent2 = $opponent2;
        $this->damages[$opponent1->getId()] = 0;
        $this->damages[$opponent2->getId()] = 0;

    }

    public function initCombat(EntityManager $entityManager): Combat
    {
        $c = new Combat();
        $c->setFirst($this->opponent1);
        $c->setSecond($this->opponent2);
        $c->setDate(new \DateTime('now'));
        $entityManager->persist($c);
        $entityManager->flush();

        return $c;
    }

    public function generateCombat(EntityManager $entityManager, WarriorService $warriorService)
    {

        $this->opponent1 = $warriorService->processStats($this->opponent1);
        $this->opponent2 = $warriorService->processStats($this->opponent2);
        $this->ratios1 = $warriorService->calculateBaseRatiosAndHp($this->opponent1);
        $this->ratios2 = $warriorService->calculateBaseRatiosAndHp($this->opponent2);
        $allOpponentsAlive = true;

        while ($allOpponentsAlive) {
            //Determine who have the initiative.
            $attacker = $this->calculateInitiative($this->opponent1, $this->opponent2);

            //Solve Attacks - Defense - Dodge - CounterAttack
            $this->calculateAction($this->opponent1, $this->opponent2, $attacker);

            //Out condition
            if ($this->damages[$this->opponent1->getId()] >= $this->ratios1['HP'] ||
                $this->damages[$this->opponent2->getId()] >= $this->ratios2['HP']) {
                $allOpponentsAlive = false;
            }


        }
    }

    /**
     * @param Warrior $opponent1
     * @param Warrior $opponent2
     * @return string
     */
    private function calculateInitiative(Warrior $opponent1, Warrior $opponent2, array $ratios1, array $ratios2): string
    {
        //methode de calcul:

        return $opponent2->getId();
    }

    /**
     * @param Warrior $opponent1
     * @param Warrior $opponent2
     * @param string $attacker
     * @return void
     */
    private function calculateAction(Warrior $opponent1, Warrior $opponent2, string $attacker)
    {
    }


}