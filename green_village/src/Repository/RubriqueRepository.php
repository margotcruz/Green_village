<?php

namespace App\Repository;

use App\Entity\Rubrique;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class RubriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rubrique::class);
    }


    public function ProduitParRubriques(Rubrique $rubrique, $marque = null, $rubriqueParentId = null, $rubriqueId = null): array
    {
        $connection = $this->getEntityManager()->getConnection();
        
        $sql = "
            SELECT DISTINCT
                p.Id_produit AS idProduit,
                p.caracteristiques AS caractreristiqueProduit,
                p.marque AS marqueProduit,
                p.libelle_modele AS modeleProduit,
                p.prix_achat_ht AS prixAchatHt,
                p.libelle_court AS libelleCourt, 
                t1.label_rubrique AS rubrique, 
                t2.label_rubrique AS sousRubrique,
                i.libelle_image AS libelleImage
            FROM 
                rubrique AS t1
            LEFT JOIN 
                rubrique AS t2 ON t2.Id_parent = t1.Id_rubrique
            INNER JOIN 
                produit AS p ON p.Id_rubrique = COALESCE(t2.Id_rubrique, t1.Id_rubrique)
            LEFT JOIN
                image_produit AS i ON i.Id_produit = p.Id_produit  
            WHERE 
                t1.Id_rubrique = :rubriqueId
        ";
    
        if ($marque) {
            $sql .= " AND p.marque = :marque";
        }
    
        if ($rubriqueParentId) {
            $sql .= " AND t1.Id_parent = :rubriqueParentId";
        }
    
        if ($rubriqueId) {
            $sql .= " AND p.Id_rubrique = :rubriqueId";
        }
    
        $stmt = $connection->prepare($sql);
        
        $params = ['rubriqueId' => $rubrique->getId()];
        if ($marque) {
            $params['marque'] = $marque;
        }
        if ($rubriqueParentId) {
            $params['rubriqueParentId'] = $rubriqueParentId;
        }
        if ($rubriqueId) {
            $params['rubriqueId'] = $rubriqueId;
        }
    
        $result = $stmt->executeQuery($params);
    
        return $result->fetchAllAssociative();
    }
    

    
}

