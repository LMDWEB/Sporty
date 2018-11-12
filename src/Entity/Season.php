<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $season_year;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonYear(): ?string
    {
        return $this->season_year;
    }

    public function setSeasonYear(string $season_year): self
    {
        $this->season_year = $season_year;

        return $this;
    }
}
