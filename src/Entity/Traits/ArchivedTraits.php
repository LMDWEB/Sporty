<?php
/**
 * Created by PhpStorm.
 * User: diegowaziri
 * Date: 12/11/2018
 * Time: 09:19
 */

namespace App\Entity\Traits;


trait ArchivedTraits
{
    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected $archived = false;

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     */
    public function setArchived(bool $archived)
    {
        $this->archived = $archived;

        return $this;
    }


}