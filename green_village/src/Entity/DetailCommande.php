<?php


// src/Entity/Detient.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'detail_commande')]
class DetailCommande
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produit::class)]
    #[ORM\JoinColumn(name: 'Id_produit', referencedColumnName: 'Id_produit')]
    private Produit $produit;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Commande::class)]
    #[ORM\JoinColumn(name: 'Id_commande', referencedColumnName: 'Id_commande')]
    private Commande $commande;

    #[ORM\Column(type: 'integer', name: 'quantite_commander')]
    private int $quantiteCommander;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 2, name: 'prix_unitaire')]
    private float $prixUnitaire;

    public function getId(): ?int
    {
        return null;
    }

    // Getters and setters
}
