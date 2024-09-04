<?php

namespace App\Controller\Admin;

use App\Entity\WhoWeArePage;
use App\Form\WhoWeArePageType;
use App\Repository\WhoWeArePageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/who/we/are/page')]
class WhoWeArePageController extends AbstractController
{
    #[Route('/', name: 'app_admin_who_we_are_page_index', methods: ['GET'])]
    public function index(WhoWeArePageRepository $whoWeArePageRepository): Response
    {
        return $this->render('admin/who_we_are_page/index.html.twig', [
            'who_we_are_pages' => $whoWeArePageRepository->findAll(),
        ]);
    }

    
    #[Route('/{id}/edit', name: 'app_admin_who_we_are_page_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WhoWeArePage $whoWeArePage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WhoWeArePageType::class, $whoWeArePage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_who_we_are_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/who_we_are_page/edit.html.twig', [
            'who_we_are_page' => $whoWeArePage,
            'form' => $form,
        ]);
    }

}
