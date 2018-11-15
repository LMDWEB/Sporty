<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
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
}
