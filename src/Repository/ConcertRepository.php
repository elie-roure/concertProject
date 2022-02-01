<?php

namespace App\Repository;

use App\Entity\Concert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Concert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concert[]    findAll()
 * @method Concert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concert::class);
    }


    // /**
    //  * @return Concert[] Returns an array of Concert objects
    //  */
    public function findFuture(){
        return $this->createQueryBuilder('c')
            ->andWhere('c.date > :val')
            ->setParameter('val', date("Y-m-d H:i:s"))
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findFutureWithId($value){
/*
        dump($this->createQueryBuilder('c')
            ->join("App\Entity\Band ","b", "on c.id = b.concert_id")
            ->andWhere('c.date > :val')
            ->andWhere('b.band_id = :id')
            ->setParameter('val', date("Y-m-d H:i:s"))
            ->setParameter('id', $value)
            ->orderBy('c.id', 'ASC')
            ->getQuery());
        die();*/

        return $this->createQueryBuilder('c')
            ->join("App\Entity\Band ","b", "c.id = b.concert_id")
            ->andWhere('c.date > :val')
            ->andWhere('b.id = :id')
            ->setParameter('val', date("Y-m-d H:i:s"))
            ->setParameter('id', $value)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findPastWithId($value){
        return $this->createQueryBuilder('c')
            ->join("App\Entity\Band ","b", "on c.id = b.concert_id")
            ->andWhere('c.date < :val')
            ->andWhere('b.id = :id')
            ->setParameter('id', $value)
            ->setParameter('val', date("Y-m-d H:i:s"))
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Concert[] Returns an array of Concert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Concert
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
