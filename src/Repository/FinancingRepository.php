<?php

namespace App\Repository;

use App\Entity\Financing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Financing>
 *
 * @method Financing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Financing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Financing[]    findAll()
 * @method Financing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinancingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Financing::class);
    }

//    /**
//     * @return Financing[] Returns an array of Financing objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Financing
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}