<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'fournisseur')]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_fournisseur')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50, name: 'nom_fournisseur')]
    private string $nomFournisseur;

    #[ORM\Column(type: 'string', length: 20, name: 'telephone_fournisseur')]
    private string $telephoneFournisseur;

    #[ORM\Column(type: 'string', length: 14, name: 'siret')]
    private string $siret;

    #[ORM\Column(type: 'string', length: 255, name: 'reference_fournisseur')]
    private string $referenceFournisseur;

    #[ORM\Column(type: 'string', length: 255, name: 'email', nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 15, name: 'type')]
    private string $type;

    // Getter et Setter pour 'id'
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter et Setter pour 'nomFournisseur'
    public function getNomFournisseur(): string
    {
        return $this->nomFournisseur;
    }

    public function setNomFournisseur(string $nomFournisseur): self
    {
        $this->nomFournisseur = $nomFournisseur;
        return $this;
    }

    // Getter et Setter pour 'telephoneFournisseur'
    public function getTelephoneFournisseur(): string
    {
        return $this->telephoneFournisseur;
    }

    public function setTelephoneFournisseur(string $telephoneFournisseur): self
    {
        $this->telephoneFournisseur = $telephoneFournisseur;
        return $this;
    }

    // Getter et Setter pour 'siret'
    public function getSiret(): string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;
        return $this;
    }

    // Getter et Setter pour 'referenceFournisseur'
    public function getReferenceFournisseur(): string
    {
        return $this->referenceFournisseur;
    }

    public function setReferenceFournisseur(string $referenceFournisseur): self
    {
        $this->referenceFournisseur = $referenceFournisseur;
        return $this;
    }

    // Getter et Setter pour 'email'
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    // Getter et Setter pour 'type'
    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
