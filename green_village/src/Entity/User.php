<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'Id_user')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'nom_user')]
    private string $nomUser;

    #[ORM\Column(type: 'string', length: 50, name: 'prenom_user')]
    private ?string $prenomUser = null;

    #[ORM\Column(type: 'string', length: 50, name: 'telephone_user')]
    private string $telephoneUser;

    #[ORM\Column(type: 'string', length: 50, name: 'email_user')]
    private string $emailUser;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToOne(targetEntity: Employe::class)]
    #[ORM\JoinColumn(name: 'Id_employe', referencedColumnName: 'Id_employe')]
    private ?Employe $employe = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $coef = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(type: 'string', length: 20, unique: true)]
    private ?string $reference = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): static
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(?string $prenomUser): static
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getTelephoneUser(): ?string
    {
        return $this->telephoneUser;
    }

    public function setTelephoneUser(string $telephoneUser): static
    {
        $this->telephoneUser = $telephoneUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->emailUser;
    }

    public function setEmailUser(string $emailUser): static
    {
        $this->emailUser = $emailUser;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): static
    {
        $this->employe = $employe;

        return $this;
    }

    public function getCoef(): ?string
    {
        return $this->coef;
    }

    public function setCoef(string $coef): static
    {
        $this->coef = $coef;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getReference(): ?string
    {
    return $this->reference;
    }

    public function setReference(string $reference): static
    {
    $this->reference = $reference;

    return $this;
    }
}
