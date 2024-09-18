<?php

namespace App\Controller\Public;

use App\Entity\Enum\LanguageEnum;
use App\Repository\BannerRepository;
use App\Repository\FinancingRepository;
use App\Repository\NewsRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\TestimonyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/public')]
class HomeController extends BaseController
{
    #[Route('/', name: 'app_public_home')]
    public function index(
        BannerRepository $bannerRepository,
        ProductCategoryRepository $productCategoryRepository,
        NewsRepository $newsRepository,
        TestimonyRepository $testimonyRepository,
        FinancingRepository $financingRepository
    ): Response {

        $banners = $bannerRepository->findBy(['language' => $this->getLanguageId(), 'active' => 1], ['position' => 'ASC']);

        $productCategories = $productCategoryRepository->findBy(['language' => $this->getLanguageId()]);

        $allNews = $newsRepository->findby(['language' => $this->getLanguageId(), 'status' => 1, 'highlighted' => 1], ['date' => 'DESC']);

        $testimonies = $testimonyRepository->findby(['language' => $this->getLanguageId(), 'status' => 1, 'highlighted' => 1], ['position' => 'ASC']);

        $allFinancing = $financingRepository->findBy(['language' => $this->getLanguageId(), 'status' => 1, 'highlighted' => 1], ['position' => 'ASC']);

        return $this->render('public/home/index.html.twig', [
            'banners' => $banners,
            'productCategories' => $productCategories,
            'allNews' => $allNews,
            'testimonies' => $testimonies,
            'allFinancing' => $allFinancing,
            'pageSeo' => $this->pageSeo,
            'generalData' => $this->generalData,
            'globalTags' => $this->globalTags,
            'urlToPostForm' => $this->urlToPostForm
        ]);
    }

    #[Route('/who-we-are', name: 'app_public_who_we_are')]
    public function whoWeAre(): Response
    {
        return $this->render('public/who-we-are/who-we-are.html.twig', [
            'pageSeo' => $this->pageSeo,
            'generalData' => $this->generalData,
            'globalTags' => $this->globalTags,
            'urlToPostForm' => $this->urlToPostForm
        ]);
    }

    #[Route('/news', name: 'app_public_news')]
    public function news(NewsRepository $newsRepository): Response
    {   
        $allNews = $newsRepository->findby(['language' => $this->getLanguageId(), 'status' => 1, 'highlighted' => 1], ['date' => 'DESC']);

        return $this->render('public/news/news.html.twig', [
            'pageSeo' => $this->pageSeo,
            'generalData' => $this->generalData,
            'globalTags' => $this->globalTags,
            'urlToPostForm' => $this->urlToPostForm,
            'allNews' => $allNews
        ]);
    }

    #[Route('/notice/{slug}', name: 'app_public_notice')]
    public function notice($slug, NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findOneBy([
            'slug' => $slug
        ]);
        return $this->render('public/news/notice.html.twig', [
            'pageSeo' => $this->pageSeo,
            'generalData' => $this->generalData,
            'globalTags' => $this->globalTags,
            'urlToPostForm' => $this->urlToPostForm,
            'news' => $news
        ]);
    }

    #[Route('/products', name: 'app_public_products')]
    public function products(ProductRepository $productRepository): Response
    {
        $allProducts = $productRepository->findby(['status' => 1,'language' => $this->getLanguageId()]);
        return $this->render('public/product/products.html.twig', [
            'pageSeo' => $this->pageSeo,
            'generalData' => $this->generalData,
            'globalTags' => $this->globalTags,
            'urlToPostForm' => $this->urlToPostForm,
            'allProducts' => $allProducts
        ]);
    }

    #[Route('/product/{slug}', name: 'app_public_product')]
    public function product($slug, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findOneBy([
            'slug' => $slug
        ]);
    
        // Verifica se o produto existe
        if (!$product) {
            throw $this->createNotFoundException('Produto não encontrado');
        }
    
        return $this->render('public/product/product.html.twig', [
            'pageSeo' => $this->pageSeo,
            'generalData' => $this->generalData,
            'globalTags' => $this->globalTags,
            'urlToPostForm' => $this->urlToPostForm,
            'product' => $product // Passa o produto encontrado
        ]);
    }
    #[Route('/financing', name: 'app_public_financing')]
    public function financing(): Response
    {
        return $this->render('public/financing/financing.html.twig', [
            'pageSeo' => $this->pageSeo,
            'generalData' => $this->generalData,
            'globalTags' => $this->globalTags,
            'urlToPostForm' => $this->urlToPostForm
        ]);
    }
}
