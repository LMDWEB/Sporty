<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $matchday;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchday(): ?string
    {
        return $this->matchday;
    }

    public function setMatchday(string $matchday): self
    {
        $this->matchday = $matchday;

        return $this;
    }
}
