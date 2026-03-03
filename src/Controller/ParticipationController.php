<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\NotificationService;

#[Route('/participation')]
final class ParticipationController extends AbstractController
{
    #[Route(name: 'app_participation_index', methods: ['GET'])]
    public function index(Request $request, ParticipationRepository $participationRepository): Response
    {
        $searchTerm = $request->query->get('q');
        $queryBuilder = $participationRepository->createQueryBuilder('p');

        if ($searchTerm) {
            $queryBuilder->andWhere('p.nomCitoyen LIKE :term')
                         ->setParameter('term', '%' . $searchTerm . '%');
        }

        $queryBuilder->orderBy('p.dateInscription', 'DESC');

        return $this->render('participation/index.html.twig', [
            'participations' => $queryBuilder->getQuery()->getResult(),
        ]);
    }

    

    #[Route('/new', name: 'app_participation_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, EvenementRepository $evenementRepository, NotificationService $notifService): Response 
{
    
    if ($request->isMethod('POST')) {
        $nomCitoyen = $request->request->get('nomCitoyen');
        
        $eventId = $request->request->get('event_id') ?? $request->request->all('participation')['evenement'] ?? null;

        if ($nomCitoyen && $eventId) {
            $evenement = $evenementRepository->find($eventId);
            if ($evenement) {
                $participation = new Participation();
                $participation->setNomCitoyen($nomCitoyen);
                $participation->setEvenement($evenement);
                $participation->setDateInscription(new \DateTime());

                $entityManager->persist($participation);
                $entityManager->flush();

                $notifService->notifyAdmin("Nouvelle Inscription", "Le citoyen $nomCitoyen s'est inscrit à : " . $evenement->getTitle());
                $this->addFlash('success', 'Confirmation envoyée !');
                
                
                return $request->request->has('event_id') ? $this->redirectToRoute('app_front') : $this->redirectToRoute('app_participation_index');
            }
        }
    }

   
    $participation = new Participation();
    $form = $this->createForm(ParticipationType::class, $participation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($participation);
        $entityManager->flush();
        return $this->redirectToRoute('app_participation_index');
    }

    return $this->render('participation/new.html.twig', [
        'participation' => $participation,
        'form' => $form->createView(),
    ]);
}


public function __construct()
{
    
    $this->dateInscription = new \DateTime();
}

    #[Route('/{id}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager, NotificationService $notifService): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $notifService->notifyAdmin(
                "Modification Participation", 
                "La participation de " . $participation->getNomCitoyen() . " a été modifiée."
            );

            $this->addFlash('success', 'Modification avec succées!');
            return $this->redirectToRoute('app_participation_index');
        }

        return $this->render('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form->createView(), 
        ]);
    }

    #[Route('/{id}', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(Request $request, Participation $participation, EntityManagerInterface $entityManager, NotificationService $notifService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->request->get('_token'))) {
            $nom = $participation->getNomCitoyen();
            
            $entityManager->remove($participation);
            $entityManager->flush();

            $notifService->notifyAdmin(
                "Annulation de Participation", 
                "Le citoyen " . $nom . " s'est retiré de l'événement."
            );

            $this->addFlash('danger', 'Participation supprimée.');
        }

        return $this->redirectToRoute('app_participation_index');
    }

    #[Route('/{id}', name: 'app_participation_show', methods: ['GET'])]
    public function show(Participation $participation): Response
    {
        return $this->render('participation/show.html.twig', [
            'participation' => $participation,
        ]);
    }
}