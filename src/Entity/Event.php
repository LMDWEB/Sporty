<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    use TimestampableEntity;
    use ArchivedTraits;

    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_REVIEW = 2;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $start_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_participant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClubTeam", inversedBy="events")
     */
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="events")
     */
    private $organizers;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->organizers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getMaxParticipant(): ?int
    {
        return $this->max_participant;
    }

    public function setMaxParticipant(?int $max_participant): self
    {
        $this->max_participant = $max_participant;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ClubTeam[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(ClubTeam $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(ClubTeam $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getOrganizers(): Collection
    {
        return $this->organizers;
    }

    public function addOrganizer(User $organizer): self
    {
        if (!$this->organizers->contains($organizer)) {
            $this->organizers[] = $organizer;
        }

        return $this;
    }

    public function removeOrganizer(User $organizer): self
    {
        if ($this->organizers->contains($organizer)) {
            $this->organizers->removeElement($organizer);
        }

        return $this;
    }
}
