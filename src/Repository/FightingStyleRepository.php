<?php

namespace App\Repository;

use App\Entity\FightingStyle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FightingStyle|null find($id, $lockMode = null, $lockVersion = null)
 * @method FightingStyle|null findOneBy(array $criteria, array $orderBy = null)
 * @method FightingStyle[]    findAll()
 * @method FightingStyle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FightingStyleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FightingStyle::class);
    }

    // /**
    //  * @return FightingStyle[] Returns an array of FightingStyle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FightingStyle
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
