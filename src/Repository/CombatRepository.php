<?php

namespace App\Repository;

use App\Entity\Combat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Combat>
 *
 * @method Combat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Combat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Combat[]    findAll()
 * @method Combat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CombatRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     * @codeCoverageIgnore
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Combat::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @codeCoverageIgnore
     */
    public function add(Combat $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @codeCoverageIgnore
     */
    public function remove(Combat $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Combat[] Returns an array of Combat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Combat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
