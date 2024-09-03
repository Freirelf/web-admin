<?php

namespace App\Entity;

use App\Repository\GlobalTagsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlobalTagsRepository::class)]
class GlobalTags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Ga4 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tagsGoogleAds = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pixelMetaAds = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGa4(): ?string
    {
        return $this->Ga4;
    }

    public function setGa4(?string $Ga4): static
    {
        $this->Ga4 = $Ga4;

        return $this;
    }

    public function getTagsGoogleAds(): ?string
    {
        return $this->tagsGoogleAds;
    }

    public function setTagsGoogleAds(?string $tagsGoogleAds): static
    {
        $this->tagsGoogleAds = $tagsGoogleAds;

        return $this;
    }

    public function getPixelMetaAds(): ?string
    {
        return $this->pixelMetaAds;
    }

    public function setPixelMetaAds(?string $pixelMetaAds): static
    {
        $this->pixelMetaAds = $pixelMetaAds;

        return $this;
    }
}
