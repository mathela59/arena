<?php

namespace App\Repository;

use App\Entity\Warrior;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Warrior>
 *
 * @method Warrior|null find($id, $lockMode = null, $lockVersion = null)
 * @method Warrior|null findOneBy(array $criteria, array $orderBy = null)
 * @method Warrior[]    findAll()
 * @method Warrior[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarriorRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     * @codeCoverageIgnore
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Warrior::class);
    }

    /**
     * @codeCoverageIgnore
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Warrior $entity, bool $flush = true): void
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
    public function remove(Warrior $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

     /**
      * @return Warrior[] Returns an array of Warrior objects
      */
    public function findOneRandomWarriorExceptThisOne($value=null)
    {
        $randSql = "SELECT warrior.id FROM warrior WHERE warrior.id != :val ORDER BY RANDOM() LIMIT 1";
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addEntityResult(Warrior::class,'warrior');
        $rsm->addFieldResult('warrior', 'id', 'id');
        $randId = $this->getEntityManager()->createNativeQuery($randSql,$rsm)
            ->setParameter("val",$value)
            ->getResult();
        dump($this->findById($randId[0]->getId()));
        die();
        return $this->findById($randId[0]->getId());
    }

    public function findOneRandomWarrior()
    {
        $randSql = "SELECT warrior.id FROM warrior ORDER BY RANDOM() LIMIT 1";
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addEntityResult(Warrior::class,'warrior');
        $rsm->addFieldResult('warrior', 'id', 'id');
        $randId = $this->getEntityManager()->createNativeQuery($randSql,$rsm)
            ->getResult();
        return $this->find($randId[0]->getId());
    }


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
