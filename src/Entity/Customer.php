<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $companyName = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $billingAddress = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Contact $referenceContact = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Contact::class, cascade: ['all'], orphanRemoval: true)]
    private Collection $otherContacts;


    #[ORM\OneToOne(mappedBy: 'customer', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: HeatActivity::class, orphanRemoval: true)]
    private Collection $heatActivities;

    public function __construct()
    {
        $this->facilities = new ArrayCollection();
        $this->otherContacts = new ArrayCollection();
        $this->heatActivities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(?Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    public function getReferenceContact(): ?Contact
    {
        return $this->referenceContact;
    }

    public function setReferenceContact(?Contact $referenceContact): self
    {
        $this->referenceContact = $referenceContact;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getOtherContacts(): Collection
    {
        return $this->otherContacts;
    }

    public function addOtherContact(Contact $otherContact): self
    {
        if (!$this->otherContacts->contains($otherContact)) {
            $this->otherContacts->add($otherContact);
            $otherContact->setCustomer($this);
        }

        return $this;
    }

    public function removeOtherContact(Contact $otherContact): self
    {
        if ($this->otherContacts->removeElement($otherContact)) {
            // set the owning side to null (unless already changed)
            if ($otherContact->getCustomer() === $this) {
                $otherContact->setCustomer(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setCustomer(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCustomer() !== $this) {
            $user->setCustomer($this);
        }

        $this->user = $user;

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
            $heatActivity->setCustomer($this);
        }

        return $this;
    }

    public function removeHeatActivity(HeatActivity $heatActivity): self
    {
        if ($this->heatActivities->removeElement($heatActivity)) {
            // set the owning side to null (unless already changed)
            if ($heatActivity->getCustomer() === $this) {
                $heatActivity->setCustomer(null);
            }
        }

        return $this;
    }
}
