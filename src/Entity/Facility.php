<?php

namespace App\Entity;

use App\Repository\FacilityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacilityRepository::class)]
class Facility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $publicMessageFr = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $publicMessageEn = null;

    #[ORM\ManyToOne(inversedBy: 'facilities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPublicMessageFr(): ?string
    {
        return $this->publicMessageFr;
    }

    public function setPublicMessageFr(string $publicMessageFr): self
    {
        $this->publicMessageFr = $publicMessageFr;

        return $this;
    }

    public function getPublicMessageEn(): ?string
    {
        return $this->publicMessageEn;
    }

    public function setPublicMessageEn(string $publicMessageEn): self
    {
        $this->publicMessageEn = $publicMessageEn;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
