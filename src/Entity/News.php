<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;


#[ORM\Entity(repositoryClass: NewsRepository::class)]
#[Uploadable]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, NewsCategory>
     */
    #[ORM\ManyToMany(targetEntity: NewsCategory::class, inversedBy: 'news')]
    private Collection $category;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    #[ORM\Column(nullable: true)]
    private ?int $highlighted = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $youtubeVideoCode = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $fullDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[UploadableField(mapping:'newsImage', fileNameProperty:'image')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $imageUpdatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $language = null;

    /**
     * @var Collection<int, NewsImage>
     */
    #[ORM\OneToMany(targetEntity: NewsImage::class, mappedBy: 'news')]
    private Collection $newsImages;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->newsImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, NewsCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(NewsCategory $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(NewsCategory $category): static
    {
        $this->category->removeElement($category);

        return $this;
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

    public function getHighlighted(): ?int
    {
        return $this->highlighted;
    }

    public function setHighlighted(?int $highlighted): static
    {
        $this->highlighted = $highlighted;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getYoutubeVideoCode(): ?string
    {
        return $this->youtubeVideoCode;
    }

    public function setYoutubeVideoCode(?string $youtubeVideoCode): static
    {
        $this->youtubeVideoCode = $youtubeVideoCode;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(?string $fullDescription): static
    {
        $this->fullDescription = $fullDescription;

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
     * @return Collection<int, NewsImage>
     */
    public function getNewsImages(): Collection
    {
        return $this->newsImages;
    }

    public function addNewsImage(NewsImage $newsImage): static
    {
        if (!$this->newsImages->contains($newsImage)) {
            $this->newsImages->add($newsImage);
            $newsImage->setNews($this);
        }

        return $this;
    }

    public function removeNewsImage(NewsImage $newsImage): static
    {
        if ($this->newsImages->removeElement($newsImage)) {
            // set the owning side to null (unless already changed)
            if ($newsImage->getNews() === $this) {
                $newsImage->setNews(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
