<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    public function recupererListeStages(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT s.id, titre, date_debut, date_fin, f.type nomFormation, e.nom nomEntreprise
        FROM stage s 
        join entreprise e on s.entreprise_id=e.id
        join stage_formation sf on sf.stage_id=s.id
        join formation f on sf.formation_id=f.id
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function recupererStage($id): array 
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT titre, date_debut, date_fin, f.type nomFormation, e.nom nomEntreprise, s.description description, contact
        FROM stage s 
        join entreprise e on s.entreprise_id=e.id
        join stage_formation sf on sf.stage_id=s.id
        join formation f on sf.formation_id=f.id
        WHERE s.id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

    // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function recupererStagesParFormation(): array 
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT s.id, titre, date_debut, date_fin, f.type nomFormation, e.nom nomEntreprise
        FROM stage s 
        join entreprise e on s.entreprise_id=e.id
        join stage_formation sf on sf.stage_id=s.id
        join formation f on sf.formation_id=f.id
        ORDER BY f.type';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function recupererStagesParEntreprise(): array 
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT s.id, titre, date_debut, date_fin, f.type nomFormation, e.nom nomEntreprise
        FROM stage s 
        join entreprise e on s.entreprise_id=e.id
        join stage_formation sf on sf.stage_id=s.id
        join formation f on sf.formation_id=f.id
        ORDER BY e.nom';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
