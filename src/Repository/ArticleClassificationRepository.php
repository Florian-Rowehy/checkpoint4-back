<?php

namespace App\Repository;

use App\Entity\ArticleClassification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleClassification|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleClassification|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleClassification[]    findAll()
 * @method ArticleClassification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleClassificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleClassification::class);
    }

    // /**
    //  * @return ArticleClassification[] Returns an array of ArticleClassification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleClassification
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
