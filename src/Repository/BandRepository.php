<?php

namespace App\Repository;

use App\Entity\Band;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Band|null find($id, $lockMode = null, $lockVersion = null)
 * @method Band|null findOneBy(array $criteria, array $orderBy = null)
 * @method Band[]    findAll()
 * @method Band[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Band::class);
    }

    public function findFutureWithId($value){

        /*dump($this->createQueryBuilder('c')
            ->join("App\Entity\Band ","b", "on c.id = b.concert_id")
            ->andWhere('c.date > :val')
            ->andWhere('b.band_id = :id')
            ->setParameter('val', date("Y-m-d H:i:s"))
            ->setParameter('id', $value)
            ->orderBy('c.id', 'ASC')
            ->getQuery());
        die();*/

        return $this->createQueryBuilder('c')
            ->select("App\Entity\Concert")
            ->from("App\Entity\Concert", "co")
            ->join("App\Entity\Band ","b", "co.id = b.concert_id")
            /*->andWhere('c.date > :val')*/
            ->andWhere('b.id = :id')
            /*->setParameter('val', date("Y-m-d H:i:s"))*/
            ->setParameter('id', $value)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Band[] Returns an array of Band objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Band
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
