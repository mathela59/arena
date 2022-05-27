<?php

namespace App\Repository;

use App\Entity\Sentence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
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
            ->getResult();
    }


    public function findOneByActionAndFightStyle($action, $fightStyleId = null, $critical = false): ?Sentence
    {
        $randSql = "SELECT sentence.id FROM sentence WHERE sentence.action = '" . $action . "'";
        $randSql .= "AND (sentence.fight_style_id = " . $fightStyleId . " OR sentence.fight_style_id is null)";
        if (!$critical)
            $randSql .= " AND sentence.critic='false'";
        else
            $randSql .= " AND sentence.critic='true'";
        $randSql .= " ORDER BY RANDOM() LIMIT 1";
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addScalarResult('id', 'id');
        $query = $this->getEntityManager()->createNativeQuery($randSql, $rsm);
        $randId = $query->getResult();

        return $this->find($randId[0]['id']);
    }

}
