<?php

namespace App\Entity;

use App\Repository\HeatActivityEntryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeatActivityEntryRepository::class)]
class HeatActivityEntry
{
    public const TYPES = [
        'Contrôle réglementaire',
        'Contrôle réglementaire réalisé par Organisme Agréé (OA)',
        'Conduite / Maintenance préventive',
        'Relevé des compteurs',
        'Dépannage',
        'Autre',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'heatActivityEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HeatActivity $heatActivity = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameOA = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comments = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $workIdentifier = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeatActivity(): ?HeatActivity
    {
        return $this->heatActivity;
    }

    public function setHeatActivity(?HeatActivity $heatActivity): self
    {
        $this->heatActivity = $heatActivity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNameOA(): ?string
    {
        return $this->nameOA;
    }

    public function setNameOA(?string $nameOA): self
    {
        $this->nameOA = $nameOA;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getWorkIdentifier(): ?string
    {
        return $this->workIdentifier;
    }

    public function setWorkIdentifier(?string $workIdentifier): self
    {
        $this->workIdentifier = $workIdentifier;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
}
