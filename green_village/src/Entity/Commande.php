<?php


// src/Entity/Commande.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'commande')]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_commande')]
    private ?int $id = null;

    #[ORM\Column(type: 'date', name: 'date_commande')]
    private \DateTimeInterface $dateCommande;

    #[ORM\Column(type: 'string', length: 50, name: 'statut_commande')]
    private string $statutCommande;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 2, name: 'montant_total')]
    private float $montantTotal;

    #[ORM\Column(type: 'boolean', name: 'mode_paiement')]
    private bool $modePaiement;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 2, name: 'reduction', nullable: true)]
    private ?float $reduction = null;

    #[ORM\Column(type: 'date', name: 'date_paiement', nullable: true)]
    private ?\DateTimeInterface $datePaiement = null;

    #[ORM\Column(type: 'string', length: 50, name: 'reference_facture')]
    private string $referenceFacture;

    #[ORM\Column(type: 'date', name: 'date_facture')]
    private \DateTimeInterface $dateFacture;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'Id_user', referencedColumnName: 'Id_user')]
    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

}
