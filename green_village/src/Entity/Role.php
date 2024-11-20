<?php


// src/Entity/Role.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'role')]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_role')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'nom_role')]
    private string $nomRole;

    #[ORM\Column(type: 'string', length: 50, name: 'niveau_role')]
    private string $niveauRole;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRole(): string
    {
        return $this->nomRole;
    }

    public function setNomRole(string $nomRole): self
    {
        $this->nomRole = $nomRole;
        return $this;
    }

    public function getNiveauRole(): string
    {
        return $this->niveauRole;
    }

    public function setNiveauRole(string $niveauRole): self
    {
        $this->niveauRole = $niveauRole;
        return $this;
    }
}
