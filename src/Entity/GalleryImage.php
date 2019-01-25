<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use App\Entity\Traits\PublishedTraits;
use App\Entity\Traits\TimestampableTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalleryImageRepository")
 * @Vich\Uploadable
 */
class GalleryImage
{

    use TimestampableTraits;
    use PublishedTraits;
    use ArchivedTraits;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="player_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="image")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     * @return $this
     */
    public function setImageFile(File $imageFile)
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // En gros, y a un bug sur vich, quand on modifie juste l'image, Symfony ne detecte aucun changement
            // Et ca persist pas l'image en base, du coup petite technique, des qu'on modifie une image, on modifie l'updateAt
            // Et comme ca l'image s'enregistre en base !
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setImage($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getImage() === $this) {
                $article->setImage(null);
            }
        }

        return $this;
    }

}
