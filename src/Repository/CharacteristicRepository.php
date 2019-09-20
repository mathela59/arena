<?php

namespace App\Repository;

use App\Entity\Characteristic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Characteristic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Characteristic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Characteristic[]    findAll()
 * @method Characteristic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacteristicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Characteristic::class);
    }

    public function findOneByShortcode($value): ?Characteristic
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.shortcode = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

}
