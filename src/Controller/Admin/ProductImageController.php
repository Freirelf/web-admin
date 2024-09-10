<?php

namespace App\Controller\Admin;

use App\Entity\ProductImage;
use App\Form\ProductImageType;
use App\Repository\ProductImageRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/product-image')]
class ProductImageController extends AbstractController
{
    
    #[Route('/{productId}', name: 'app_admin_product_image_index', methods: ['GET'])]
    public function index(ProductImageRepository $productImageRepository,  $productId, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($productId);
        return $this->render('admin/product_image/index.html.twig', [
            'product_images' => $productImageRepository->findBy(['product' => $productId]),
            'product' => $product
        ]);
    }

    #[Route('/{productId}/new', name: 'app_admin_product_image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,  $productId, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($productId);
        $productImage = new ProductImage();
        $form = $this->createForm(ProductImageType::class, $productImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productImage->setProduct($product);
            $entityManager->persist($productImage);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_product_image_index', ['productId' => $productId], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/product_image/new.html.twig', [
            'product_image' => $productImage,
            'form' => $form,
            'product' => $product
        ]);
    }

    #[Route('/{id}', name: 'app_admin_product_image_show', methods: ['GET'])]
    public function show(ProductImage $productImage): Response
    {
        return $this->render('admin/product_image/show.html.twig', [
            'product_image' => $productImage,
        ]);
    }

    #[Route('/{productId}/{id}/edit', name: 'app_admin_product_image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductImage $productImage, EntityManagerInterface $entityManager,  $productId, ProductRepository $productRepository): Response
    {   
        $product = $productRepository->find($productId);
        $form = $this->createForm(ProductImageType::class, $productImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productImage->setProduct($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_product_image_index', ['productId' => $productId], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/product_image/edit.html.twig', [
            'product_image' => $productImage,
            'form' => $form,
            'product' => $product
        ]);
    }

    #[Route('/{productId}/{id}', name: 'app_admin_product_image_delete', methods: ['POST'])]
    public function delete(Request $request, ProductImage $productImage, EntityManagerInterface $entityManager, $productId, ProductRepository $productRepository): Response
    {   
        $product = $productRepository->find($productId);
        if ($this->isCsrfTokenValid('delete'.$productImage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($productImage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_product_image_index', ['productId' => $productId], Response::HTTP_SEE_OTHER);
    }
}
