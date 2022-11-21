<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Imagen::class)]
    private Collection $imagens;

    public function __construct()
    {
        $this->imagens = new ArrayCollection();
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
     * @return Collection<int, Imagen>
     */
    public function getImagens(): Collection
    {
        return $this->imagens;
    }

    public function addImagen(Imagen $imagen): self
    {
        if (!$this->imagens->contains($imagen)) {
            $this->imagens->add($imagen);
            $imagen->setCategory($this);
        }

        return $this;
    }

    public function removeImagen(Imagen $imagen): self
    {
        if ($this->imagens->removeElement($imagen)) {
            // set the owning side to null (unless already changed)
            if ($imagen->getCategory() === $this) {
                $imagen->setCategory(null);
            }
        }

        return $this;
    }
}
