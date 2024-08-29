<?php

namespace App\Controller\Admin;

use App\Entity\NewsCategory;
use App\Form\NewsCategoryType;
use App\Repository\NewsCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/news/category')]
class NewsCategoryController extends AbstractController
{
    #[Route('/', name: 'app_admin_news_category_index', methods: ['GET'])]
    public function index(NewsCategoryRepository $newsCategoryRepository): Response
    {
        return $this->render('admin/news_category/index.html.twig', [
            'news_categories' => $newsCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_news_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $newsCategory = new NewsCategory();
        $form = $this->createForm(NewsCategoryType::class, $newsCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newsCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_news_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/news_category/new.html.twig', [
            'news_category' => $newsCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_news_category_show', methods: ['GET'])]
    public function show(NewsCategory $newsCategory): Response
    {
        return $this->render('admin/news_category/show.html.twig', [
            'news_category' => $newsCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_news_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NewsCategory $newsCategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewsCategoryType::class, $newsCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_news_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/news_category/edit.html.twig', [
            'news_category' => $newsCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_news_category_delete', methods: ['POST'])]
    public function delete(Request $request, NewsCategory $newsCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsCategory->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($newsCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_news_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
