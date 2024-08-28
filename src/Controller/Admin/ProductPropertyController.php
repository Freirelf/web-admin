<?php

namespace App\Controller\Admin;

use App\Entity\ProductProperty;
use App\Form\ProductPropertyType;
use App\Repository\ProductPropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/product-property')]
class ProductPropertyController extends AbstractController
{
    #[Route('/', name: 'app_admin_product_property_index', methods: ['GET'])]
    public function index(ProductPropertyRepository $productPropertyRepository): Response
    {
        return $this->render('admin/product_property/index.html.twig', [
            'product_properties' => $productPropertyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_product_property_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productProperty = new ProductProperty();
        $form = $this->createForm(ProductPropertyType::class, $productProperty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productProperty);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_product_property_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/product_property/new.html.twig', [
            'product_property' => $productProperty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_product_property_show', methods: ['GET'])]
    public function show(ProductProperty $productProperty): Response
    {
        return $this->render('admin/product_property/show.html.twig', [
            'product_property' => $productProperty,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_product_property_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductProperty $productProperty, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductPropertyType::class, $productProperty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_product_property_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/product_property/edit.html.twig', [
            'product_property' => $productProperty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_product_property_delete', methods: ['POST'])]
    public function delete(Request $request, ProductProperty $productProperty, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productProperty->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($productProperty);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_product_property_index', [], Response::HTTP_SEE_OTHER);
    }
}
