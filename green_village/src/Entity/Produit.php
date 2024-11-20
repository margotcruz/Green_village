<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'produit')]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_produit')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50, name: 'libelle_court')]
    private string $libelleCourt;

    #[ORM\Column(type: 'string', length: 255, name: 'description_long')]
    private string $descriptionLong;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 2, name: 'prix_achat_ht')]
    private float $prixAchatHt;

    #[ORM\Column(type: 'boolean', name: 'statut_produit', nullable: true)]
    private ?bool $statutProduit = null;

    #[ORM\Column(type: 'string', length: 50, name: 'stock_produit', nullable: true)]
    private ?string $stockProduit = null;

    #[ORM\Column(type: 'string', length: 255, name: 'marque', nullable: true)]
    private ?string $marque = null;

    #[ORM\Column(type: 'string', length: 255, name: 'libelle_modele')]
    private string $libelleModele;

    #[ORM\ManyToOne(targetEntity: Fournisseur::class)]
    #[ORM\JoinColumn(name: 'Id_fournisseur', referencedColumnName: 'Id_fournisseur')]
    private Fournisseur $fournisseur;

    #[ORM\ManyToOne(targetEntity: Rubrique::class)]
    #[ORM\JoinColumn(name: 'Id_rubrique', referencedColumnName: 'Id_rubrique')]
    private Rubrique $rubrique;

    // Getter for Id
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter and setter for libelleCourt
    public function getLibelleCourt(): string
    {
        return $this->libelleCourt;
    }

    public function setLibelleCourt(string $libelleCourt): self
    {
        $this->libelleCourt = $libelleCourt;
        return $this;
    }

    // Getter and setter for descriptionLong
    public function getDescriptionLong(): string
    {
        return $this->descriptionLong;
    }

    public function setDescriptionLong(string $descriptionLong): self
    {
        $this->descriptionLong = $descriptionLong;
        return $this;
    }

    // Getter and setter for prixAchatHt
    public function getPrixAchatHt(): float
    {
        return $this->prixAchatHt;
    }

    public function setPrixAchatHt(float $prixAchatHt): self
    {
        $this->prixAchatHt = $prixAchatHt;
        return $this;
    }

    // Getter and setter for statutProduit
    public function getStatutProduit(): ?bool
    {
        return $this->statutProduit;
    }

    public function setStatutProduit(?bool $statutProduit): self
    {
        $this->statutProduit = $statutProduit;
        return $this;
    }

    // Getter and setter for stockProduit
    public function getStockProduit(): ?string
    {
        return $this->stockProduit;
    }

    public function setStockProduit(?int $stockProduit): self
    {
        $this->stockProduit = $stockProduit;
        if ($stockProduit > 0) {
            $this->statutProduit = true;  
        } else {
            $this->statutProduit = false; 
        }
        return $this;
    }

    
    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;
        return $this;
    }

   
    public function getLibelleModele(): string
    {
        return $this->libelleModele;
    }

    public function setLibelleModele(string $libelleModele): self
    {
        $this->libelleModele = $libelleModele;
        return $this;
    }

    public function getFournisseur(): Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;
        return $this;
    }

    public function getRubrique(): Rubrique
    {
        return $this->rubrique;
    }

    public function setRubrique(Rubrique $rubrique): self
    {
        $this->rubrique = $rubrique;
        return $this;
    }
}
