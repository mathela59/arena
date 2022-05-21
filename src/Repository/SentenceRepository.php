<?php

namespace App\Repository;

use App\Entity\Sentence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sentence>
 *
 * @method Sentence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sentence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sentence[]    findAll()
 * @method Sentence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SentenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sentence::class);
    }

    /**
     * @codeCoverageIgnore
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Sentence $entity, bool $flush = true): void
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
    public function remove(Sentence $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

     /**
      * @return Sentence[] Returns an array of Sentence objects
      */

    public function findByActionSorted($action): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.action = :val')
            ->setParameter('val', $action)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneByActionAndFightStyle($action,$fightStyleId=null,$critical=false): ?Sentence
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.action = :val')
            ->andWhere('s.fight_style_id = :val2 OR s.figth_style_id is null')
            ->andWhere('s.critic = :val3')
            ->setParameter('val', $action)
            ->setParameter('val2', $fightStyleId)
            ->setParameter('val3',$critical)
            ->orderBy('RAND()')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }

}
