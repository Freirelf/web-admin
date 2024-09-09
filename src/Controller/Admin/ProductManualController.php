<?php

namespace App\Controller\Admin;

use App\Entity\ProductManual;
use App\Form\ProductManualType;
use App\Repository\ProductManualRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/product-manual')]
class ProductManualController extends AbstractController
{
    #[Route('/{productId}', name: 'app_admin_product_manual_index', methods: ['GET'])]
    public function index(ProductManualRepository $productManualRepository, $productId, ProductRepository $productRepository): Response
    {   
        $product = $productRepository->find($productId);
        return $this->render('admin/product_manual/index.html.twig', [
            'product_manuals' => $productManualRepository->findBy(['product' => $productId]),
            'product' => $product
        ]);
    }

    #[Route('/{productId}/new', name: 'app_admin_product_manual_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $productId, ProductRepository $productRepository): Response
    {   
        $product = $productRepository->find($productId);
        $productManual = new ProductManual();
        $form = $this->createForm(ProductManualType::class, $productManual);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productManual);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_product_manual_index', ['productId' => $productId], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/product_manual/new.html.twig', [
            'product_manual' => $productManual,
            'form' => $form,
            'product' => $product
        ]);
    }

    #[Route('/{productId}/{id}/edit', name: 'app_admin_product_manual_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductManual $productManual, EntityManagerInterface $entityManager, $productId, ProductRepository $productRepository): Response
    {   
        $product = $productRepository->find($productId);
        $form = $this->createForm(ProductManualType::class, $productManual);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_product_manual_index', ['productId' => $productId], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/product_manual/edit.html.twig', [
            'product_manual' => $productManual,
            'form' => $form,
            'product' => $product
        ]);
    }

    #[Route('/{productId}/{id}', name: 'app_admin_product_manual_delete', methods: ['POST'])]
    public function delete(Request $request, ProductManual $productManual, EntityManagerInterface $entityManager, $productId, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productManual->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($productManual);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_product_manual_index', ['productId' => $productId], Response::HTTP_SEE_OTHER);
    }
}
