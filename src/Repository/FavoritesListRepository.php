<?php

namespace App\Repository;

use App\Entity\FavoritesList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FavoritesList|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavoritesList|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavoritesList[]    findAll()
 * @method FavoritesList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoritesListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavoritesList::class);
    }

    // /**
    //  * @return FavoritesList[] Returns an array of FavoritesList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FavoritesList
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
