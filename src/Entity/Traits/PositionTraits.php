<?php
/**
 * Created by PhpStorm.
 * User: diegowaziri
 * Date: 12/11/2018
 * Time: 09:56
 */

namespace App\Entity\Traits;


trait PositionTraits
{
    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer", nullable=false)
     */
    private $position;

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }
}