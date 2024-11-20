<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'employe')]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'Id_employe')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, name: 'nom_employe')]
    private string $nomEmploye;

    #[ORM\Column(type: 'string', length: 255, name: 'reference_employe')]
    private string $referenceEmploye;

    #[ORM\Column(type: 'string', length: 50, name: 'telephone_employe')]
    private string $telephoneEmploye;

    #[ORM\Column(type: 'string', length: 255, nullable: true, name: 'email_employe')]
    private ?string $emailEmploye = null;

    #[ORM\ManyToOne(targetEntity: Service::class)]
    #[ORM\JoinColumn(name: 'Id_service', referencedColumnName: 'Id_service')]
    private Service $service;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEmploye(): string
    {
        return $this->nomEmploye;
    }

    public function setNomEmploye(string $nomEmploye): self
    {
        $this->nomEmploye = $nomEmploye;

        return $this;
    }

    public function getReferenceEmploye(): string
    {
        return $this->referenceEmploye;
    }

    public function setReferenceEmploye(string $referenceEmploye): self
    {
        $this->referenceEmploye = $referenceEmploye;

        return $this;
    }

    public function getTelephoneEmploye(): string
    {
        return $this->telephoneEmploye;
    }

    public function setTelephoneEmploye(string $telephoneEmploye): self
    {
        $this->telephoneEmploye = $telephoneEmploye;

        return $this;
    }

    public function getEmailEmploye(): ?string
    {
        return $this->emailEmploye;
    }

    public function setEmailEmploye(?string $emailEmploye): self
    {
        $this->emailEmploye = $emailEmploye;

        return $this;
    }

    public function getService(): Service
    {
        return $this->service;
    }

    public function setService(Service $service): self
    {
        $this->service = $service;

        return $this;
    }
}
