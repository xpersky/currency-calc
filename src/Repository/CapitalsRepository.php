<?php

namespace App\Repository;

use App\Entity\Capitals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Capitals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capitals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capitals[]    findAll()
 * @method Capitals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapitalsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Capitals::class);
    }

    // /**
    //  * @return Capitals[] Returns an array of Capitals objects
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
    public function findOneBySomeField($value): ?Capitals
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
