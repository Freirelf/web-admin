<?php

namespace App\Repository;

use App\Entity\NewsCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NewsCategory>
 */
class NewsCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsCategory::class);
    }

    //    /**
    //     * @return NewsCategory[] Returns an array of NewsCategory objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?NewsCategory
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
