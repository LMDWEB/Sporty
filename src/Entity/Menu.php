<?php

namespace App\Entity;

use App\Entity\Traits\PublishedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
{

    use PublishedTraits;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MenuItem", mappedBy="parent_id")
     */
    private $menuItems;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Menu", mappedBy="parent")
     */
    private $menus;

    /**
     * @ORM\Column(type="boolean")
     */
    private $parent;

    public function __construct()
    {
        $this->menuItems = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

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

    /**
     * @return Collection|MenuItem[]
     */
    public function getMenuItems(): Collection
    {
        return $this->menuItems;
    }

    public function addMenuItem(MenuItem $menuItem): self
    {
        if (!$this->menuItems->contains($menuItem)) {
            $this->menuItems[] = $menuItem;
            $menuItem->setParent($this);
        }

        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem): self
    {
        if ($this->menuItems->contains($menuItem)) {
            $this->menuItems->removeElement($menuItem);
            // set the owning side to null (unless already changed)
            if ($menuItem->getParent() === $this) {
                $menuItem->setParent(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection|self[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function getParent(): ?bool
    {
        return $this->parent;
    }

    public function setParent(bool $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
