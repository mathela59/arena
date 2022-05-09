<?php

namespace App\Repository;

use App\Entity\Slots;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Slots>
 *
 * @method Slots|null find($id, $lockMode = null, $lockVersion = null)
 * @method Slots|null findOneBy(array $criteria, array $orderBy = null)
 * @method Slots[]    findAll()
 * @method Slots[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlotsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Slots::class);
    }

    /**
     * @codeCoverageIgnore
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Slots $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @codeCoverageIgnore
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Slots $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Slots[] Returns an array of Slots objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /**
     * @codeCoverageIgnore
     * @param $value
     * @return Slots|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByName($value): ?Slots
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
