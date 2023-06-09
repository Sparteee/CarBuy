<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Voiture $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Voiture $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function countAllVoiture(){
        return $this->createQueryBuilder('v')
            ->select('COUNT(v.id) as voiture')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function FindByMarque($marq){
        return $this->createQueryBuilder('v')
            ->innerJoin('v.marque' , 'm')
            ->where('m.nom = :marque')
            ->setParameter(':marque' , $marq)
            ->getQuery()
            ->getResult();
    }

    public function FindByCategorie($cat){
        return $this->createQueryBuilder('v')
            ->innerJoin('v.categorie' , 'c')
            ->where('c.name = :cat')
            ->setParameter(':cat' , $cat)
            ->getQuery()
            ->getResult();
    }

    public function FindByArguments($cat,$marq,$transmission , $carburant){
        return $this->createQueryBuilder('v')
            ->innerJoin('v.categorie' , 'c')
            ->innerJoin('v.marque' , 'm')
            ->andWhere('c.name = :cat AND m.nom = :marque AND v.Vitesse = :trans AND v.Carburant = :carbu')
            ->setParameter(':cat' , $cat )
            ->setParameter(':marque' , $marq)
            ->setParameter(':trans' , $transmission)
            ->setParameter(':carbu' , $carburant)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Voiture[] Returns an array of Voiture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voiture
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
