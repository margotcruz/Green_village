<?php


namespace App\Entity;

use App\Entity\Employe;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'echange')]
class Echange
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', name: 'Id_echange')]
    private ?int $id = null;

    #[ORM\Column(type: 'date', name: 'date_echange')]
    private \DateTimeInterface $dateEchange;

    #[ORM\Column(type: 'string', length: 50, name: 'sujet_echange')]
    private string $sujetEchange;

    #[ORM\Column(type: 'string', length: 255, name: 'type_echange', nullable: true)]
    private ?string $typeEchange = null;

    #[ORM\Column(type: 'string', length: 255, name: 'description_echange', nullable: true)]
    private ?string $descriptionEchange = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'Id_user', referencedColumnName: 'Id_user')]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Employe::class)]
    #[ORM\JoinColumn(name: 'Id_employe', referencedColumnName: 'Id_employe')]
    private Employe $employe;

    public function getId(): ?int
    {
        return $this->id;
    }

    // Getters and setters
}
