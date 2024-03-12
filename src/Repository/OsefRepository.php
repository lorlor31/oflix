<?php

namespace App\Repository;

use App\Entity\Osef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Osef>
 *
 * @method Osef|null find($id, $lockMode = null, $lockVersion = null)
 * @method Osef|null findOneBy(array $criteria, array $orderBy = null)
 * @method Osef[]    findAll()
 * @method Osef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OsefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Osef::class);
    }

//    /**
//     * @return Osef[] Returns an array of Osef objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Osef
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
