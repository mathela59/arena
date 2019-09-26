<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Warrior;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Warrior|null find($id, $lockMode = null, $lockVersion = null)
 * @method Warrior|null findOneBy(array $criteria, array $orderBy = null)
 * @method Warrior[]    findAll()
 * @method Warrior[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarriorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Warrior::class);
    }

//    /**
//     * @param int $user
//     * @return Warrior[] Returns an array of Warrior objects
//     */
//    public function findByUserId(int $user)
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.user_id = :val')
//            ->setParameter('val', $user)
//            ->orderBy('w.id', 'ASC')
//            ->getQuery()
//            ->getResult();
//    }

    /*
    public function findOneBySomeField($value): ?Warrior
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
