<?php

// src/Entity/Rubrique.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'rubrique')]
class Rubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_rubrique')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'libelle_image')]
    private string $libelleImage;

    #[ORM\Column(type: 'string', length: 255, name: 'label_rubrique')]
    private string $labelRubrique;

    #[ORM\ManyToOne(targetEntity: Rubrique::class)]
    #[ORM\JoinColumn(name: 'Id_rubrique_id_sous_rubrique', referencedColumnName: 'Id_rubrique')]
    private ?Rubrique $parentRubrique = null;

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

    public function getLabelRubrique(): string
    {
        return $this->labelRubrique;
    }

    public function setLabelRubrique(string $labelRubrique): self
    {
        $this->labelRubrique = $labelRubrique;
        return $this;
    }

    public function getParentRubrique(): ?Rubrique
    {
        return $this->parentRubrique;
    }

    public function setParentRubrique(?Rubrique $parentRubrique): self
    {
        $this->parentRubrique = $parentRubrique;
        return $this;
    }
}
