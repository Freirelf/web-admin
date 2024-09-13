<?php

namespace App\Controller\Admin;

use App\Entity\Financing;
use App\Repository\FinancingRepository;
use App\Form\FinancingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/financing')]
class FinancingController extends AbstractController
{
    #[Route('/', name: 'app_admin_financing_index', methods: ['GET'])]
    public function index(FinancingRepository $financingRepository): Response
    {
        return $this->render('admin/financing/index.html.twig', [
            'financings' => $financingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_financing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $financing = new Financing();
        $form = $this->createForm(FinancingType::class, $financing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($financing);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_financing_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/financing/new.html.twig', [
            'financing' => $financing,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_admin_financing_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Financing $financing, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FinancingType::class, $financing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_financing_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/financing/edit.html.twig', [
            'financing' => $financing,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_financing_delete', methods: ['POST'])]
    public function delete(Request $request, Financing $financing, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$financing->getId(), $request->request->get('_token'))) {
            $entityManager->remove($financing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_financing_index', [], Response::HTTP_SEE_OTHER);
    }
}