<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfigurationRepository")
 */
class Configuration
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nameConfig;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valueConfig;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameConfig(): ?string
    {
        return $this->nameConfig;
    }

    public function setNameConfig(string $nameConfig): self
    {
        $this->nameConfig = $nameConfig;

        return $this;
    }

    public function getValueConfig(): ?string
    {
        return $this->valueConfig;
    }

    public function setValueConfig(string $valueConfig): self
    {
        $this->valueConfig = $valueConfig;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
