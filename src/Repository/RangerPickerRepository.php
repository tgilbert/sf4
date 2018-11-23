<?php

namespace App\Repository;

use App\Entity\RangerPicker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RangerPicker|null find($id, $lockMode = null, $lockVersion = null)
 * @method RangerPicker|null findOneBy(array $criteria, array $orderBy = null)
 * @method RangerPicker[]    findAll()
 * @method RangerPicker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangerPickerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RangerPicker::class);
    }

    // /**
    //  * @return RangerPicker[] Returns an array of RangerPicker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RangerPicker
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
