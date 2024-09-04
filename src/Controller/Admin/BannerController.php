<?php

namespace App\Controller\Admin;

use App\Entity\Banner;
use App\Form\BannerType;
use App\Repository\BannerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/banner')]
class BannerController extends AbstractController
{
    #[Route('/', name: 'app_admin_banner_index', methods: ['GET'])]
    public function index(BannerRepository $bannerRepository): Response
    {
        return $this->render('admin/banner/index.html.twig', [
            'banners' => $bannerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_banner_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $banner = new Banner();
        $form = $this->createForm(BannerType::class, $banner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($banner);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_banner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/banner/new.html.twig', [
            'banner' => $banner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_banner_show', methods: ['GET'])]
    public function show(Banner $banner): Response
    {
        return $this->render('admin/banner/show.html.twig', [
            'banner' => $banner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_banner_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Banner $banner, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BannerType::class, $banner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_banner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/banner/edit.html.twig', [
            'banner' => $banner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_banner_delete', methods: ['POST'])]
    public function delete(Request $request, Banner $banner, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banner->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($banner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_banner_index', [], Response::HTTP_SEE_OTHER);
    }
}
