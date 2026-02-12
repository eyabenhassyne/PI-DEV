<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/participation')]
final class ParticipationController extends AbstractController
{
    // ISLAH: Khallina fonction index wa7da barka fiha el recherche wel tri
    #[Route(name: 'app_participation_index', methods: ['GET'])]
    public function index(Request $request, ParticipationRepository $participationRepository): Response
    {
        $searchTerm = $request->query->get('q');
        $sortBy = $request->query->get('sort', 'id');
        $direction = $request->query->get('direction', 'DESC');

        $queryBuilder = $participationRepository->createQueryBuilder('p');

        if ($searchTerm) {
            // ISLAH: Nesta3mlou 'p.evenement' (esm el propriété) mouch idEvenement
            // W nesta3mlou 'p.idCitoyen'
            $queryBuilder->leftJoin('p.evenement', 'e') // Join bech n-najmou n-lawjou f'el evenement
                         ->andWhere('p.idCitoyen LIKE :term OR e.id LIKE :term')
                         ->setParameter('term', '%'.$searchTerm.'%');
        }

        // ISLAH: Thabbet ken t-7ebb t-rattib 7asb el 'evenement' (relation) lezmou ykoun 'e.id'
        if ($sortBy === 'evenement') {
            $queryBuilder->orderBy('p.evenement', $direction);
        } else {
            $queryBuilder->orderBy('p.' . $sortBy, $direction);
        }

        return $this->render('participation/index.html.twig', [
            'participations' => $queryBuilder->getQuery()->getResult(),
        ]);
    }

    #[Route('/new', name: 'app_participation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $participation = new Participation();
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($participation);
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participation/new.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation_show', methods: ['GET'])]
    public function show(Participation $participation): Response
    {
        return $this->render('participation/show.html.twig', [
            'participation' => $participation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
    }
}