<?php

namespace App\Controller\Admin;

use App\Entity\GeneralData;
use App\Form\GeneralDataType;
use App\Repository\GeneralDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/general/data')]
class GeneralDataController extends AbstractController
{
    #[Route('/{id}/edit', name: 'app_admin_general_data_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GeneralData $generalDatum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GeneralDataType::class, $generalDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_general_data_edit', ['id'=>$generalDatum->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/general_data/edit.html.twig', [
            'general_datum' => $generalDatum,
            'form' => $form,
        ]);
    }
}
