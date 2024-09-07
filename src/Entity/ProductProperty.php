<?php

namespace App\Entity;

use App\Repository\ProductPropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductPropertyRepository::class)]
class ProductProperty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?int $language = null;

    /**
     * @var Collection<int, ProductPropertyValue>
     */
    #[ORM\OneToMany(targetEntity: ProductPropertyValue::class, mappedBy: 'productProperty')]
    private Collection $productPropertyValues;

    public function __construct()
    {
        $this->productPropertyValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getLanguage(): ?int
    {
        return $this->language;
    }

    public function setLanguage(?int $language): static
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Collection<int, ProductPropertyValue>
     */
    public function getProductPropertyValues(): Collection
    {
        return $this->productPropertyValues;
    }

    public function addProductPropertyValue(ProductPropertyValue $productPropertyValue): static
    {
        if (!$this->productPropertyValues->contains($productPropertyValue)) {
            $this->productPropertyValues->add($productPropertyValue);
            $productPropertyValue->setProductProperty($this);
        }

        return $this;
    }

    public function removeProductPropertyValue(ProductPropertyValue $productPropertyValue): static
    {
        if ($this->productPropertyValues->removeElement($productPropertyValue)) {
            // set the owning side to null (unless already changed)
            if ($productPropertyValue->getProductProperty() === $this) {
                $productPropertyValue->setProductProperty(null);
            }
        }

        return $this;
    }
}
