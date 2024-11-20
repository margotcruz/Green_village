<?php


// src/Entity/Livraison.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'livraison')]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_livraison')]
    private ?int $id = null;

    #[ORM\Column(type: 'date', name: 'date_edition', nullable: true)]
    private ?\DateTimeInterface $dateEdition = null;

    #[ORM\Column(type: 'boolean', name: 'statut_livraison')]
    private bool $statutLivraison;

    #[ORM\Column(type: 'string', length: 50, name: 'reference_livraison')]
    private string $referenceLivraison;

    #[ORM\ManyToOne(targetEntity: Commande::class)]
    #[ORM\JoinColumn(name: 'Id_commande', referencedColumnName: 'Id_commande')]
    private Commande $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

}
