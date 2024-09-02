<?php

namespace App\Entity;

use App\Repository\PageSeoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageSeoRepository::class)]
class PageSeo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $homePageTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $homePageDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $aboutUsPageTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $aboutUsPageDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $productListingPageTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $productListingPageDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $newsListingPageTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $newsListingPageDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $serviceListingPageTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $serviceListingPageDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $financingListPageTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $financingListPageDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $videoListingPageTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $videoListingPageDescription = null;

    #[ORM\Column(nullable: true)]
    private ?int $language = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHomePageTitle(): ?string
    {
        return $this->homePageTitle;
    }

    public function setHomePageTitle(string $homePageTitle): static
    {
        $this->homePageTitle = $homePageTitle;

        return $this;
    }

    public function getHomePageDescription(): ?string
    {
        return $this->homePageDescription;
    }

    public function setHomePageDescription(string $homePageDescription): static
    {
        $this->homePageDescription = $homePageDescription;

        return $this;
    }

    public function getAboutUsPageTitle(): ?string
    {
        return $this->aboutUsPageTitle;
    }

    public function setAboutUsPageTitle(string $aboutUsPageTitle): static
    {
        $this->aboutUsPageTitle = $aboutUsPageTitle;

        return $this;
    }

    public function getAboutUsPageDescription(): ?string
    {
        return $this->aboutUsPageDescription;
    }

    public function setAboutUsPageDescription(string $aboutUsPageDescription): static
    {
        $this->aboutUsPageDescription = $aboutUsPageDescription;

        return $this;
    }

    public function getProductListingPageTitle(): ?string
    {
        return $this->productListingPageTitle;
    }

    public function setProductListingPageTitle(string $productListingPageTitle): static
    {
        $this->productListingPageTitle = $productListingPageTitle;

        return $this;
    }

    public function getProductListingPageDescription(): ?string
    {
        return $this->productListingPageDescription;
    }

    public function setProductListingPageDescription(string $productListingPageDescription): static
    {
        $this->productListingPageDescription = $productListingPageDescription;

        return $this;
    }

    public function getNewsListingPageTitle(): ?string
    {
        return $this->newsListingPageTitle;
    }

    public function setNewsListingPageTitle(string $newsListingPageTitle): static
    {
        $this->newsListingPageTitle = $newsListingPageTitle;

        return $this;
    }

    public function getNewsListingPageDescription(): ?string
    {
        return $this->newsListingPageDescription;
    }

    public function setNewsListingPageDescription(string $newsListingPageDescription): static
    {
        $this->newsListingPageDescription = $newsListingPageDescription;

        return $this;
    }

    public function getServiceListingPageTitle(): ?string
    {
        return $this->serviceListingPageTitle;
    }

    public function setServiceListingPageTitle(string $serviceListingPageTitle): static
    {
        $this->serviceListingPageTitle = $serviceListingPageTitle;

        return $this;
    }

    public function getServiceListingPageDescription(): ?string
    {
        return $this->serviceListingPageDescription;
    }

    public function setServiceListingPageDescription(string $serviceListingPageDescription): static
    {
        $this->serviceListingPageDescription = $serviceListingPageDescription;

        return $this;
    }

    public function getFinancingListPageTitle(): ?string
    {
        return $this->financingListPageTitle;
    }

    public function setFinancingListPageTitle(string $financingListPageTitle): static
    {
        $this->financingListPageTitle = $financingListPageTitle;

        return $this;
    }

    public function getFinancingListPageDescription(): ?string
    {
        return $this->financingListPageDescription;
    }

    public function setFinancingListPageDescription(string $financingListPageDescription): static
    {
        $this->financingListPageDescription = $financingListPageDescription;

        return $this;
    }

    public function getVideoListingPageTitle(): ?string
    {
        return $this->videoListingPageTitle;
    }

    public function setVideoListingPageTitle(string $videoListingPageTitle): static
    {
        $this->videoListingPageTitle = $videoListingPageTitle;

        return $this;
    }

    public function getVideoListingPageDescription(): ?string
    {
        return $this->videoListingPageDescription;
    }

    public function setVideoListingPageDescription(string $videoListingPageDescription): static
    {
        $this->videoListingPageDescription = $videoListingPageDescription;

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
