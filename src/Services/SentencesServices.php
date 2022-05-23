<?php

namespace App\Services;

use App\Entity\CombatLines;
use App\Entity\Sentence;
use App\Entity\Warrior;
use App\Repository\SentenceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Boolean;

class SentencesServices
{


    private EntityManager $em;
    private SentenceRepository $sr;

    public function __construct(EntityManagerInterface $entityManager,
                                SentenceRepository $sentenceRepository)
    {
        $this->em = $entityManager;
        $this->sr = $sentenceRepository;
    }

    public function initCombat($attacker, $defender, array $options = []): array
    {
        $returnedSentences = $this->sr->findByActionSorted('BEGIN');

        return $returnedSentences;
    }

    /**
     * @param Warrior $attacker
     * @param bool $critical
     * @return Sentence
     */
    public function attack(Warrior $attacker, bool $critical=false): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('ATT', $attacker->getFightStyle(),$critical);
    }

    /**
     * @param Warrior $defender
     * @return Sentence
     */
    public function parry(Warrior $defender): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('DEF', $defender->getFightStyle());
    }

    /**
     * @param Warrior $defender
     * @return Sentence
     */
    public function dodge(Warrior $defender): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('DOD', $defender->getFightStyle());
    }

    /**
     * @param Warrior $defender
     * @return Sentence
     */
    public function counter(Warrior $defender): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('RIP', $defender->getFightStyle());
    }

    /**
     * @param Warrior $attacker
     * @return Sentence|null
     */
    public function damage(Warrior $attacker)
    {
        return $this->sr->findOneByActionAndFightStyle('DAMAGES',$attacker->getFightStyle());
    }

    /**
     * @param Warrior $warrior
     * @return Sentence
     */
    public function victory(Warrior $warrior): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('VICTORY', $warrior->getFightStyle());
    }

    /**
     * @return array
     */
    public function closeCombat(): array
    {
        return $this->sr->findByActionSorted('END');
    }

    /**
     * @return Sentence
     */
    public function ambiant(): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('AMBIANT', null);
    }

    /**
     * @return Sentence
     */
    public function ambiantAtt(): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('AMBIANT_ATT', null);
    }

    /**
     * @return Sentence
     */
    public function ambiantDef(): Sentence
    {
        return $this->sr->findOneByActionAndFightStyle('AMBIANT_ATT', null);
    }

    public function convert(Sentence $sentence, Warrior $attacker, Warrior $defender): CombatLines
    {
        $c = new CombatLines();
        $text = str_replace('##ATT##',$attacker->getName(),$sentence);
        $text = str_replace('##DEF##',$defender->getName(),$text);
        $c->setText($text);
        return $c;
    }
}