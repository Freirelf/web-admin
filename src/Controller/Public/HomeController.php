<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/public', name: 'app_public_home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_public_home')]
    public function index(TranslatorInterface $translator): Response
    {   
        return $this->render('public/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/who-we-are', name: 'app_public_who_we_are')]
    public function whoWeAre(): Response
    {
        return $this->render('public/who-we-are/who-we-are.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/news', name: 'app_public_news')]
    public function news(): Response
    {
        return $this->render('public/news/news.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/notice/{slug}', name: 'app_public_notice')]
    public function notice(): Response
    {
        return $this->render('public/news/notice.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/products', name: 'app_public_products')]
    public function products(): Response
    {
        return $this->render('public/product/products.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/product/{slug}', name: 'app_public_product')]
    public function product(): Response
    {
        return $this->render('public/product/product.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/financing', name: 'app_public_financing')]
    public function financing(): Response
    {
        return $this->render('public/financing/financing.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
