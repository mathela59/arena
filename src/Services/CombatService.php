<?php

namespace App\Services;

use App\Entity\Combat;
use App\Entity\Warrior;
use Container3uoFGkY\getCache_ValidatorExpressionLanguageService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class CombatService
{
    private Warrior $opponent1;
    private Warrior $opponent2;
    private array $ratios1;
    private array $ratios2;
    private array $damages;
    private int $token;
    private int $attackerId;
    private EntityManager $em;
    private SentencesServices $ss;
    private WarriorService $ws;
    private Combat $combat;

    public function __construct( EntityManagerInterface $entityManager,
                                 SentencesServices $sentencesService, WarriorService $warriorService)
    {
        $this->em = $entityManager;
        $this->ss = $sentencesService;
        $this->ws = $warriorService;
    }

    public function initCombat(Warrior $opponent1, Warrior $opponent2)
    {
        $this->opponent1 = $opponent1;
        dump($this->opponent1);
//        dump($this->opponent2);
        $this->opponent2 = $opponent2;
        $this->damages[$opponent1->getId()] = 0;
        $this->damages[$opponent2->getId()] = 0;

        $c = new Combat();
        $c->setFirst($this->opponent1);
        $c->setSecond($this->opponent2);
        $c->setDate(new \DateTime('now'));
        $this->em->persist($c);
        $this->em->flush();
        $this->combat = $c;
    }

    public function generateCombat()
    {
        $this->opponent1 = $this->ws->processStats($this->opponent1);
        $this->opponent2 = $this->ws->processStats($this->opponent2);
        $this->opponent1->setRatios($this->ws->calculateBaseRatiosAndHp($this->opponent1));
        $this->opponent2->setRatios($this->ws->calculateBaseRatiosAndHp($this->opponent2));
        $allOpponentsAlive = true;

        while ($allOpponentsAlive) {
            //Determine who have the initiative.
            $attacker = $this->calculateInitiative();
            if ($this->opponent1->getId() === $attacker->getId()) {
                $defender = $this->opponent2;
            } else {
                $defender = $this->opponent1;
            }

            //Solve Attacks - Defense - Dodge - CounterAttack
            $actionResult = $this->calculateAction($attacker);
            switch ($actionResult) {
                case "AT":
                    $dmg = $this->resolveDamages(false, $attacker);
                    $sentence = $this->ss->attack($attacker);
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));
                    unset($sentence);
                    $sentence = $this->ss->damage($attacker);
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));
                    break;
                case "CAT" :
                    $dmg = $this->resolveDamages(true, $attacker);
                    $sentence = $this->ss->attack($attacker, true);
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));
                    unset($sentence);
                    $sentence = $this->ss->damage($attacker);
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));

                    break;
                case "DE" :
                    $this->parry($defender);
                    $sentence = $this->ss->parry($defender);
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));
                    break;
                case "ES" :
                    $this->dodge($defender);
                    $sentence = $this->ss->dodge($defender);
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));
                    break;
                case "CA" :
                    $this->counter($defender);
                    $sentence = $this->ss->counter($defender);
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));
                    break;
                default:
                    $sentence = $this->ss->ambiant();
                    $this->combat->addCombatLine($this->ss->convert($sentence, $attacker, $defender));
            };
            //Out condition
            if ($this->damages[$this->opponent1->getId()] >= $this->opponent1->ratios1['HP'] ||
                $this->damages[$this->opponent2->getId()] >= $this->ratios2['HP']) {
                $allOpponentsAlive = false;
            }


        }
        $this->closeCombat();
    }


    private function calculateInitiative(): Warrior
    {
        if ($this->token <= 0) {
            $this->token = rand(0, 5);
        }

        if ($this->opponent1->getOneRatio('VI') > $this->opponent2->getOneRatio('VI')) {
            $this->opponent1->setOneRatio('VI', $this->opponent1->getOneRatio('VI') - $this->token);
            return $this->opponent1;
        } else {
            $this->opponent2->setOneRatio('VI', $this->opponent2->getOneRatio('VI') - $this->token);
            return $this->opponent2;
        }

    }


    private function calculateAction(Warrior $attacker): string
    {
        //affecting attacker and defender
        if ($this->opponent1->getId() == $attacker->getId()) {
            $attacker = $this->opponent1;
            $ratiosAt = $this->ratios1;
            $defender = $this->opponent2;
            $ratiosDe = $this->ratios2;
        } else {
            $attacker = $this->opponent2;
            $ratiosAt = $this->ratios2;
            $defender = $this->opponent1;
            $ratiosDe = $this->ratios1;
        }

        //check if a new phase needs to begin
        if ($attacker->getOneRatio('VI') < 0 || $defender->getOneRatio('VI') < 0) {
            //new phase

            //reinit ratio['VI']
            $attacker->setOneRatio('VI', $this->ws->calculateBaseViRatio($attacker));
            $defender->setOneRatio('VI', $this->ws->calculateBaseViRatio($defender));
        }


        //Calcul Attack score
        $attack = $ratiosAt['AT'] + rand(0, 100);
        //calcul Defense score
        $defense = $ratiosDe['DE'] + rand(0, 100);


        //If attack is greater than defense => damages calculation
        $critical = false;
        if ($attack > $defense) {
            if ($attack / 2 > $defense) {
                return "CAT";
            }
            return "AT";
        } else {
            //Defense success
            //no damages but let's check if the init has been reduced
            if (rand(0, 100) > $defender->getOneRatio('RE')) {
                $defender->setOneRatio('VI', $defender->getOneRatio('VI') - $this->token);
                return "DE";
            } else {
                //let's check if the defender dodges the attack.
                if (rand(0, 100) > $defender->getOneRatio('ES')) {
                    //Dodge it !!
                    //No damages !
                    //Is he able to make a counter Attack
                    if (rand(0, 100) < 5) {
                        //Counter Attack !!!
                        //Current attack collapse
                        return "CA";
                    } else {
                        return "ES";
                    }
                } else {
                    //It a simple defense with no init reduction.
                    return "DE";
                }
            }
        }
    }

    private function resolveDamages(bool $critical, Warrior $attacker): string
    {
        if ($this->opponent1->getId() === $attacker->getId()) {
            $defender = $this->opponent2;
        } else {
            $defender = $this->opponent1;
        }

        //damage calculation
        if ($critical) {
            $damages = $attacker->getOneRatio('DG') * 1.5;
        } else
            $damages = $attacker->getOneRatio('DG');

        $this->damages[$defender->getId()] += $damages - $defender->getOneRatio('AC');
        if (($defender->getOneRatio('HP') - $this->damages[$defender->getId()]) < $defender->getOneRatio('HP') / 5) {
            //Resist dice
            if (rand(0, 100) < $defender->getOneRatio('RE'))
                return "RE";
            else
                return "DT";
        } else {
            return "RE";
        }
    }

    private function parry(string $attacker)
    {
        //@TODO - Actually does nothing - anticipate for futur evolutions
    }

    private function dodge(string $attacker)
    {
        //@TODO - Actually does nothing - anticipate for futur evolutions
    }

    private function counter(string $attacker)
    {
        //invert VI ratio to inverse the order
        $tmp = $this->opponent1->getOneRatio('VI');
        $this->opponent1->setOneRatio('VI', $this->opponent2->getOneRatio('VI'));
        $this->opponent2->setOneRatio('VI', $tmp);
    }

    private function closeCombat()
    {
        //check who is the winner
        if ($this->opponent1->getOneRatio('HP') > $this->damages[$this->opponent1->getId()]) {
            $winner = $this->opponent1;
            $loser = $this->opponent2;
        } else {
            $winner = $this->opponent2;
            $loser = $this->opponent1;
        }

        //add the last combat lines ant persist it
        $this->combat->addCombatLine($this->ss->convert($this->ss->victory($winner), $winner, $loser));
        $this->combat->addCombatLine($this->ss->convert($this->ss->closeCombat(), $winner, $loser));

        $this->em->persist($this->combat);


    }

    /**
     * @return Combat
     */
    public function getCombat(): Combat
    {
        return $this->combat;
    }


}