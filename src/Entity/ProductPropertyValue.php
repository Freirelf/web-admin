<?php

namespace App\Entity;

use App\Repository\ProductPropertyValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductPropertyValueRepository::class)]
class ProductPropertyValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'productPropertyValues')]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'productPropertyValues')]
    private ?ProductProperty $productProperty = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $value = null;

    #[ORM\Column(nullable: true)]
    private ?int $language = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getProductProperty(): ?ProductProperty
    {
        return $this->productProperty;
    }

    public function setProductProperty(?ProductProperty $productProperty): static
    {
        $this->productProperty = $productProperty;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): static
    {
        $this->value = $value;

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
}
