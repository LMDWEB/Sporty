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
<<<<<<< HEAD
     * @ORM\Column(type="integer")
     */
    private $format;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="competitions")
     */
    private $section;

    /**
     * @ORM\Column(type="integer")
     */
    private $typeClub;

    /**
     * @ORM\Column(type="integer")
     */
    private $division;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Confederation", inversedBy="competitions")
     */
    private $confederation;


=======
     * @ORM\OneToMany(targetEntity="App\Entity\SeasonCompetition", mappedBy="name")
     */
    private $image;

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }
    
>>>>>>> refs/remotes/origin/master
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

<<<<<<< HEAD
    public function getFormat(): ?int
    {
        return $this->format;
    }

    public function setFormat(int $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getSection(): ?Team
    {
        return $this->section;
    }

    public function setSection(?Team $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getTypeClub(): ?bool
    {
        return $this->typeClub;
    }

    public function setTypeClub(bool $typeClub): self
    {
        $this->typeClub = $typeClub;

        return $this;
    }

    public function getDivision(): ?int
    {
        return $this->division;
    }

    public function setDivision(int $division): self
    {
        $this->division = $division;
=======
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
>>>>>>> refs/remotes/origin/master

        return $this;
    }

<<<<<<< HEAD
    public function getConfederation(): ?Confederation
    {
        return $this->confederation;
    }

    public function setConfederation(?Confederation $confederation): self
    {
        $this->confederation = $confederation;
=======
    public function removeImage(SeasonCompetition $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getName() === $this) {
                $image->setName(null);
            }
        }
>>>>>>> refs/remotes/origin/master

        return $this;
    }
}
