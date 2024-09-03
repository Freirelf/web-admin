<?php

namespace App\Controller\Admin;

use App\Entity\ContactFormUrlPost;
use App\Form\ContactFormUrlPostType;
use App\Repository\ContactFormUrlPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/contact/form/url/post')]
class ContactFormUrlPostController extends AbstractController
{
    #[Route('/{id}/edit', name: 'app_admin_contact_form_url_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactFormUrlPost $contactFormUrlPost, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactFormUrlPostType::class, $contactFormUrlPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_contact_form_url_post_edit', ['id' => $contactFormUrlPost->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/contact_form_url_post/edit.html.twig', [
            'contact_form_url_post' => $contactFormUrlPost,
            'form' => $form,
        ]);
    }
}
