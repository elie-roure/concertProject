<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $max_capacity;

    /**
     * @ORM\OneToMany(targetEntity=Venue::class, mappedBy="place")
     */
    private $venues;

    public function __construct()
    {
        $this->venues = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMaxCapacity(): ?string
    {
        return $this->max_capacity;
    }

    public function setMaxCapacity(string $max_capacity): self
    {
        $this->max_capacity = $max_capacity;

        return $this;
    }

    /**
     * @return Collection|Venue[]
     */
    public function getVenues(): Collection
    {
        return $this->venues;
    }

    public function addVenue(Venue $venue): self
    {
        if (!$this->venues->contains($venue)) {
            $this->venues[] = $venue;
            $venue->setPlace($this);
        }

        return $this;
    }

    public function removeVenue(Venue $venue): self
    {
        if ($this->venues->removeElement($venue)) {
            // set the owning side to null (unless already changed)
            if ($venue->getPlace() === $this) {
                $venue->setPlace(null);
            }
        }

        return $this;
    }
}
