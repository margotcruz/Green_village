<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'service')]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'Id_service')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'nom_service')]
    private string $nomService;

    #[ORM\Column(type: 'string', length: 20, name: 'telephone_service')]
    private string $telephoneService;

    #[ORM\Column(type: 'string', length: 255, name: 'email_service')]
    private string $emailService;

    #[ORM\ManyToOne(targetEntity: Role::class)]
    #[ORM\JoinColumn(name: 'Id_role', referencedColumnName: 'Id_role')]
    private Role $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomService(): string
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): self
    {
        $this->nomService = $nomService;

        return $this;
    }

    public function getTelephoneService(): string
    {
        return $this->telephoneService;
    }

    public function setTelephoneService(string $telephoneService): self
    {
        $this->telephoneService = $telephoneService;

        return $this;
    }

    public function getEmailService(): string
    {
        return $this->emailService;
    }

    public function setEmailService(string $emailService): self
    {
        $this->emailService = $emailService;

        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;

        return $this;
    }
}
