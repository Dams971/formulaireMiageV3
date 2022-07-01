<?php

namespace App\Repository;

use App\Entity\Questions;
use App\Entity\Formulaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Formulaires>
 *
 * @method Formulaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formulaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formulaires[]    findAll()
 * @method Formulaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formulaires::class);
    }

    public function add(Formulaires $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Formulaires $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Formulaires[] Returns an array of Formulaires objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Formulaires
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function countAllFormulaires()
    {
        $querybuilder = $this->createQueryBuilder('a');
        $querybuilder->select('COUNT(a.id) as value');

        try {
            return $querybuilder->getQuery()->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }
}
