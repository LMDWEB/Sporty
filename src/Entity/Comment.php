<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ip_address;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_post;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $name_post;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_parent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function setIpAddress(string $ip_address): self
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    public function getIdPost(): ?int
    {
        return $this->id_post;
    }

    public function setIdPost(int $id_post): self
    {
        $this->id_post = $id_post;

        return $this;
    }

    public function getNamePost(): ?string
    {
        return $this->name_post;
    }

    public function setNamePost(string $name_post): self
    {
        $this->name_post = $name_post;

        return $this;
    }

    public function getIdParent(): ?int
    {
        return $this->id_parent;
    }

    public function setIdParent(?int $id_parent): self
    {
        $this->id_parent = $id_parent;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
