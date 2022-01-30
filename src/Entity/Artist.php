<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
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
    private $scene_name;

    /**
     * @ORM\ManyToMany(targetEntity=Band::class, mappedBy="artists")
     */
    private $bands;

    /**
     * @ORM\OneToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     */
    private $picture;

    public function __construct()
    {
        $this->bands = new ArrayCollection();
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

    public function getSceneName(): ?string
    {
        return $this->scene_name;
    }

    public function setSceneName(string $scene_name): self
    {
        $this->scene_name = $scene_name;

        return $this;
    }

    /**
     * @return Collection|Band[]
     */
    public function getBands(): Collection
    {
        return $this->bands;
    }

    public function addBand(Band $band): self
    {
        if (!$this->bands->contains($band)) {
            $this->bands[] = $band;
            $band->addArtist($this);
        }

        return $this;
    }

    public function removeBand(Band $band): self
    {
        if ($this->bands->removeElement($band)) {
            $band->removeArtist($this);
        }

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
