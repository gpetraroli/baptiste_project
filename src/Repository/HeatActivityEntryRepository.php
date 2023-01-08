<?php

namespace App\Repository;

use App\Entity\HeatActivityEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HeatActivityEntry>
 *
 * @method HeatActivityEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeatActivityEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeatActivityEntry[]    findAll()
 * @method HeatActivityEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeatActivityEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeatActivityEntry::class);
    }

    public function save(HeatActivityEntry $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HeatActivityEntry $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HeatActivityEntry[] Returns an array of HeatActivityEntry objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HeatActivityEntry
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
