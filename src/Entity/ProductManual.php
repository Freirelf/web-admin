<?php

namespace App\Entity;

use App\Repository\ProductManualRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: ProductManualRepository::class)]
#[Uploadable]

class ProductManual
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fileName = null;

    #[UploadableField(mapping:'productManual', fileNameProperty:'fileName')]
    private ?File $manualFile = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $fileUpdatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'productManuals')]
    private ?Product $product = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getManualFile(): ?File
    {
        return $this->manualFile;
    }

    public function setManualFile(?File $manualFile = null): void
    {
        $this->manualFile = $manualFile;
        if(null !== $manualFile) {
            $this->fileUpdatedAt = new DateTimeImmutable();
        }
    }

    public function getManualUpdatedAt(): ?DateTimeImmutable
    {
        return $this->fileUpdatedAt;
    }

    public function setManualUpdatedAt(?DateTimeImmutable $fileUpdatedAt): void
    {
        $this->fileUpdatedAt = $fileUpdatedAt;
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
}
