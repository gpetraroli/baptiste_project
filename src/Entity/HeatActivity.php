<?php

namespace App\Entity;

use App\Repository\ActivityHeatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityHeatRepository::class)]
class HeatActivity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToOne(inversedBy: 'heatActivities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Facility $facility = null;

    #[ORM\OneToMany(mappedBy: 'heatActivity', targetEntity: HeatActivityEntry::class)]
    private Collection $heatActivityEntries;

    public function __construct()
    {
        $this->heatActivityEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getFacility(): ?Facility
    {
        return $this->facility;
    }

    public function setFacility(?Facility $facility): self
    {
        $this->facility = $facility;

        return $this;
    }

    /**
     * @return Collection<int, HeatActivityEntry>
     */
    public function getHeatActivityEntries(): Collection
    {
        return $this->heatActivityEntries;
    }

    public function addHeatActivityEntry(HeatActivityEntry $heatActivityEntry): self
    {
        if (!$this->heatActivityEntries->contains($heatActivityEntry)) {
            $this->heatActivityEntries->add($heatActivityEntry);
            $heatActivityEntry->setHeatActivity($this);
        }

        return $this;
    }

    public function removeHeatActivityEntry(HeatActivityEntry $heatActivityEntry): self
    {
        if ($this->heatActivityEntries->removeElement($heatActivityEntry)) {
            // set the owning side to null (unless already changed)
            if ($heatActivityEntry->getHeatActivity() === $this) {
                $heatActivityEntry->setHeatActivity(null);
            }
        }

        return $this;
    }
}
