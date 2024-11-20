<?php


// src/Entity/EstLivree.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'detail_livraison')]
class DetailLivraison
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produit::class)]
    #[ORM\JoinColumn(name: 'Id_produit', referencedColumnName: 'Id_produit')]
    private Produit $produit;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Livraison::class)]
    #[ORM\JoinColumn(name: 'Id_livraison', referencedColumnName: 'Id_livraison')]
    private Livraison $livraison;

    #[ORM\Column(type: 'integer', name: 'quantite_livrer')]
    private int $quantiteLivrer;

    public function getId(): ?int
    {
        return null;
    }

    // Getters and setters
}
