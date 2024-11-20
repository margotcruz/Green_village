<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'adresse')]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_adresse')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'adresse', nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'string', length: 255, name: 'adresse_complementaire', nullable: true)]
    private ?string $adresseComplementaire = null;

    #[ORM\Column(type: 'string', length: 5, name: 'code_postal', nullable: true)]
    private ?string $codePostal = null;

    #[ORM\Column(type: 'string', length: 50, name: 'ville', nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(type: 'boolean', name: 'statut')]
    private bool $statut;

    #[ORM\Column(type: 'string', length: 20, name: 'telephone_suplementaire', nullable: true)]
    private ?string $telephoneSupplementaire = null;

    #[ORM\ManyToOne(targetEntity: Fournisseur::class)]
    #[ORM\JoinColumn(name: 'Id_fournisseur', referencedColumnName: 'Id_fournisseur', nullable: true)]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'Id_user', referencedColumnName: 'Id_user', nullable: true)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getAdresseComplementaire(): ?string
    {
        return $this->adresseComplementaire;
    }

    public function setAdresseComplementaire(?string $adresseComplementaire): self
    {
        $this->adresseComplementaire = $adresseComplementaire;
        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;
        return $this;
    }

    public function getStatut(): bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getTelephoneSupplementaire(): ?string
    {
        return $this->telephoneSupplementaire;
    }

    public function setTelephoneSupplementaire(?string $telephoneSupplementaire): self
    {
        $this->telephoneSupplementaire = $telephoneSupplementaire;
        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        if ($fournisseur) {
            $this->user = null; // Assure qu'un User ne peut pas être lié si un Fournisseur est défini
        }
        $this->fournisseur = $fournisseur;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        if ($user) {
            $this->fournisseur = null; // Assure qu'un Fournisseur ne peut pas être lié si un User est défini
        }
        $this->user = $user;
        return $this;
    }
}
