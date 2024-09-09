<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[Uploadable]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $youtubeVideo = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ProductCategory $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[UploadableField(mapping:'productImage', fileNameProperty:'image')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $imageUpdatedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $language = null;

    /**
     * @var Collection<int, ProductPropertyValue>
     */
    #[ORM\OneToMany(targetEntity: ProductPropertyValue::class, mappedBy: 'product')]
    private Collection $productPropertyValues;

    /**
     * @var Collection<int, ProductImage>
     */
    #[ORM\OneToMany(targetEntity: ProductImage::class, mappedBy: 'product')]
    private Collection $productImages;

    /**
     * @var Collection<int, ProductManual>
     */
    #[ORM\OneToMany(targetEntity: ProductManual::class, mappedBy: 'product')]
    private Collection $productManuals;

    public function __construct()
    {
        $this->productPropertyValues = new ArrayCollection();
        $this->productImages = new ArrayCollection();
        $this->productManuals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getYoutubeVideo(): ?string
    {
        return $this->youtubeVideo;
    }

    public function setYoutubeVideo(?string $youtubeVideo): static
    {
        $this->youtubeVideo = $youtubeVideo;

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if(null !== $imageFile) {
            $this->imageUpdatedAt = new DateTimeImmutable();
        }
    }

    public function getImageUpdatedAt(): ?DateTimeImmutable
    {
        return $this->imageUpdatedAt;
    }

    public function setImageUpdatedAt(?DateTimeImmutable $imageUpdatedAt): void
    {
        $this->imageUpdatedAt = $imageUpdatedAt;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $productPropertyValue->setProduct($this);
        }

        return $this;
    }

    public function removeProductPropertyValue(ProductPropertyValue $productPropertyValue): static
    {
        if ($this->productPropertyValues->removeElement($productPropertyValue)) {
            // set the owning side to null (unless already changed)
            if ($productPropertyValue->getProduct() === $this) {
                $productPropertyValue->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductImage>
     */
    public function getProductImages(): Collection
    {
        return $this->productImages;
    }

    public function addProductImage(ProductImage $productImage): static
    {
        if (!$this->productImages->contains($productImage)) {
            $this->productImages->add($productImage);
            $productImage->setProduct($this);
        }

        return $this;
    }

    public function removeProductImage(ProductImage $productImage): static
    {
        if ($this->productImages->removeElement($productImage)) {
            // set the owning side to null (unless already changed)
            if ($productImage->getProduct() === $this) {
                $productImage->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductManual>
     */
    public function getProductManuals(): Collection
    {
        return $this->productManuals;
    }

    public function addProductManual(ProductManual $productManual): static
    {
        if (!$this->productManuals->contains($productManual)) {
            $this->productManuals->add($productManual);
            $productManual->setProduct($this);
        }

        return $this;
    }

    public function removeProductManual(ProductManual $productManual): static
    {
        if ($this->productManuals->removeElement($productManual)) {
            // set the owning side to null (unless already changed)
            if ($productManual->getProduct() === $this) {
                $productManual->setProduct(null);
            }
        }

        return $this;
    }
}
