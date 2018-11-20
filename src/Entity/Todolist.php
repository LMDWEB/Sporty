<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use App\Entity\Traits\TimestampableTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodolistRepository")
 */
class Todolist
{
    use TimestampableTraits;
    use ArchivedTraits;
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="todolists")
     */
    private $assignedUser;

    public function __construct()
    {
        $this->assignedUser = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    /**
     * @return Collection|User[]
     */
    public function getAssignedUser(): Collection
    {
        return $this->assignedUser;
    }

    public function addAssignedUser(User $assignedUser): self
    {
        if (!$this->assignedUser->contains($assignedUser)) {
            $this->assignedUser[] = $assignedUser;
        }

        return $this;
    }

    public function removeAssignedUser(User $assignedUser): self
    {
        if ($this->assignedUser->contains($assignedUser)) {
            $this->assignedUser->removeElement($assignedUser);
        }

        return $this;
    }

}
