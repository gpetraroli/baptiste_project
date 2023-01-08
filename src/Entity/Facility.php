<?php

namespace App\Entity;

use App\Repository\FacilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacilityRepository::class)]
class Facility
{
    public const FACILITY_TYPES = [
        'heat' => 'heat',
//        'pool' => 'pool',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'facilities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(length: 80)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consultLink = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $entryLink = null;

    #[ORM\OneToMany(mappedBy: 'facility', targetEntity: HeatActivity::class, cascade: ['all'], orphanRemoval: true)]
    private Collection $heatActivities;


    public function __construct()
    {
        $this->heatActivities = new ArrayCollection();
    }

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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getConsultLink(): ?string
    {
        return $this->consultLink;
    }

    public function setConsultLink(string $consultLink): self
    {
        $this->consultLink = $consultLink;

        return $this;
    }

    /**
     * @return Collection<int, HeatActivity>
     */
    public function getHeatActivities(): Collection
    {
        return $this->heatActivities;
    }

    public function addHeatActivity(HeatActivity $heatActivity): self
    {
        if (!$this->heatActivities->contains($heatActivity)) {
            $this->heatActivities->add($heatActivity);
            $heatActivity->setFacility($this);
        }

        return $this;
    }

    public function removeHeatActivity(HeatActivity $heatActivity): self
    {
        if ($this->heatActivities->removeElement($heatActivity)) {
            // set the owning side to null (unless already changed)
            if ($heatActivity->getFacility() === $this) {
                $heatActivity->setFacility(null);
            }
        }

        return $this;
    }

    public function getEntryLink(): ?string
    {
        return $this->entryLink;
    }

    public function setEntryLink(?string $entryLink): self
    {
        $this->entryLink = $entryLink;

        return $this;
    }
}
