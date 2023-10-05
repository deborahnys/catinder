<?php

namespace App\Repository;

use App\Entity\UserLikeCat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserLikeCat>
 *
 * @method UserLikeCat|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserLikeCat|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserLikeCat[]    findAll()
 * @method UserLikeCat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserLikeCatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLikeCat::class);
    }

//    /**
//     * @return UserLikeCat[] Returns an array of UserLikeCat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserLikeCat
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
