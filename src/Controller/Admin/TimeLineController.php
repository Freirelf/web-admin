<?php

namespace App\Controller\Admin;

use App\Entity\TimeLine;
use App\Form\TimeLineType;
use App\Repository\TimeLineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/time/line')]
class TimeLineController extends AbstractController
{
    #[Route('/', name: 'app_admin_time_line_index', methods: ['GET'])]
    public function index(TimeLineRepository $timeLineRepository): Response
    {
        return $this->render('admin/time_line/index.html.twig', [
            'time_lines' => $timeLineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_time_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $timeLine = new TimeLine();
        $form = $this->createForm(TimeLineType::class, $timeLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($timeLine);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_time_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/time_line/new.html.twig', [
            'time_line' => $timeLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_time_line_show', methods: ['GET'])]
    public function show(TimeLine $timeLine): Response
    {
        return $this->render('admin/time_line/show.html.twig', [
            'time_line' => $timeLine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_time_line_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TimeLine $timeLine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TimeLineType::class, $timeLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_time_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/time_line/edit.html.twig', [
            'time_line' => $timeLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_time_line_delete', methods: ['POST'])]
    public function delete(Request $request, TimeLine $timeLine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timeLine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($timeLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_time_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
