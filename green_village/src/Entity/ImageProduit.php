<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'image_produit')]
class ImageProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'Id_image_produit')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'libelle_image')]
    private string $libelleImage;

    #[ORM\ManyToOne(targetEntity: Produit::class)]
    #[ORM\JoinColumn(name: 'Id_produit', referencedColumnName: 'Id_produit')]
    private Produit $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleImage(): string
    {
        return $this->libelleImage;
    }

    public function setLibelleImage(string $libelleImage): self
    {
        $this->libelleImage = $libelleImage;

        return $this;
    }

    public function getProduit(): Produit
    {
        return $this->produit;
    }

    public function setProduit(Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
