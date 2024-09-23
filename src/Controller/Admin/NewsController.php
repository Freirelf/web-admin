<?php

namespace App\Controller\Admin;

use App\Entity\Log;
use App\Entity\News;
use App\Form\NewsType;
use App\Repository\LogRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/news')]
class NewsController extends AbstractController
{
    #[Route('/', name: 'app_admin_news_index', methods: ['GET'])]
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('admin/news/index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($news->getTitle().' '.$news->getId());
            $news->setSlug($slug);
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/news/new.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_news_show', methods: ['GET'])]
    public function show(News $news): Response
    {
        return $this->render('admin/news/show.html.twig', [
            'news' => $news,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, News $news, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($news->getTitle().' '.$news->getId());
            $news->setSlug($slug);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/news/edit.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_news_delete', methods: ['POST'])]
    public function delete(Request $request, News $news, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($news);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_news_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/log', name: 'app_admin_news_log', methods: ['GET'])]
    public function log($id, NewsRepository $newsRepository, LogRepository $logRepository): Response
    {
        return $this->render('admin/news/log.html.twig', [
            'logs' => $logRepository->findBy(['entity'=>'App\Entity\News',
            'entityId' => $id
        ])
        ]);
    }
}
