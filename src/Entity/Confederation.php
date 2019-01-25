<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfederationRepository")
 */
class Confederation
{

    const CONTINENT = [
        0 => 'Europe',
        1 => 'Afrique',
        2 => 'Asie',
        3 => 'Amérique du Nord',
        4 => 'Amérique du Sud',
        5 => 'Océanie',
        6 => 'Monde'
    ];


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $continent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="confederation")
     */
    private $competitions;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
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

    public function getContinent(): ?int
    {
        return $this->continent;
    }

    public function getContinentName(): ?string
    {
        return self::CONTINENT[$this->continent];
    }

    public function setContinent(int $continent): self
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): self
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions[] = $competition;
            $competition->setConfederation($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            // set the owning side to null (unless already changed)
            if ($competition->getConfederation() === $this) {
                $competition->setConfederation(null);
            }
        }

        return $this;
    }
}
