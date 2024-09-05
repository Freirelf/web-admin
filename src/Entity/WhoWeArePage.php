<?php

namespace App\Entity;

use App\Repository\WhoWeArePageRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: WhoWeArePageRepository::class)]
#[Uploadable]
class WhoWeArePage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $presentation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $presentationPart2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $presentationPart3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $youtubeVideoCode = null;

    #[ORM\Column(nullable: true)]
    private ?int $language = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image1 = null;

    #[UploadableField(mapping:'whoWeAreImage', fileNameProperty:'image1')]
    private ?File $imageFile1 = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $imageUpdatedAt1= null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image2 = null;

    #[UploadableField(mapping:'whoWeAreImage', fileNameProperty:'image2')]
    private ?File $imageFile2 = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $imageUpdatedAt2= null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image3 = null;

    #[UploadableField(mapping:'whoWeAreImage', fileNameProperty:'image3')]
    private ?File $imageFile3 = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $imageUpdatedAt3= null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getPresentationPart2(): ?string
    {
        return $this->presentationPart2;
    }

    public function setPresentationPart2(?string $presentationPart2): static
    {
        $this->presentationPart2 = $presentationPart2;

        return $this;
    }

    public function getPresentationPart3(): ?string
    {
        return $this->presentationPart3;
    }

    public function setPresentationPart3(?string $presentationPart3): static
    {
        $this->presentationPart3 = $presentationPart3;

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

    public function getLanguage(): ?int
    {
        return $this->language;
    }

    public function setLanguage(?int $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(?string $image1): static
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImageFile1(): ?File
    {
        return $this->imageFile1;
    }

    public function setImageFile1(?File $imageFile1 = null): void
    {
        $this->imageFile1 = $imageFile1;
        if(null !== $imageFile1) {
            $this->imageUpdatedAt1 = new DateTimeImmutable();
        }
    }

    public function getImageUpdatedAt1(): ?DateTimeImmutable
    {
        return $this->imageUpdatedAt1;
    }

    public function setImageUpdatedAt1(?DateTimeImmutable $imageUpdatedAt1): void
    {
        $this->imageUpdatedAt1 = $imageUpdatedAt1;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): static
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImageFile2(): ?File
    {
        return $this->imageFile2;
    }

    public function setImageFile2(?File $imageFile2 = null): void
    {
        $this->imageFile2 = $imageFile2;
        if(null !== $imageFile2) {
            $this->imageUpdatedAt2 = new DateTimeImmutable();
        }
    }

    public function getImageUpdatedAt2(): ?DateTimeImmutable
    {
        return $this->imageUpdatedAt2;
    }

    public function setImageUpdatedAt2(?DateTimeImmutable $imageUpdatedAt2): void
    {
        $this->imageUpdatedAt2 = $imageUpdatedAt2;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): static
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImageFile3(): ?File
    {
        return $this->imageFile3;
    }

    public function setImageFile3(?File $imageFile3 = null): void
    {
        $this->imageFile3 = $imageFile3;
        if(null !== $imageFile3) {
            $this->imageUpdatedAt3 = new DateTimeImmutable();
        }
    }

    public function getImageUpdatedAt3(): ?DateTimeImmutable
    {
        return $this->imageUpdatedAt3;
    }

    public function setImageUpdatedAt3(?DateTimeImmutable $imageUpdatedAt3): void
    {
        $this->imageUpdatedAt3 = $imageUpdatedAt3;
    }
    

}
