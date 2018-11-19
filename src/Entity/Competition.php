<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
{

    use TimestampableEntity;
    use ArchivedTraits;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SeasonCompetition", mappedBy="name")
     */
    private $image;

    public function __construct()
    {
        $this->image = new ArrayCollection();
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

    /**
     * @return Collection|SeasonCompetition[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(SeasonCompetition $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setName($this);
        }

        return $this;
    }

    public function removeImage(SeasonCompetition $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getName() === $this) {
                $image->setName(null);
            }
        }

        return $this;
    }
}
