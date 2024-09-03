<?php

namespace App\Controller\Admin;

use App\Entity\GlobalTags;
use App\Form\GlobalTagsType;
use App\Repository\GlobalTagsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/global/tags')]
class GlobalTagsController extends AbstractController
{
   #[Route('/{id}/edit', name: 'app_admin_global_tags_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GlobalTags $globalTag, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GlobalTagsType::class, $globalTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_global_tags_edit', ['id' => $globalTag->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/global_tags/edit.html.twig', [
            'global_tag' => $globalTag,
            'form' => $form,
        ]);
    }

}
