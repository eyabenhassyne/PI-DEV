<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\NotificationService; // 1. Zidna el Service mta3 el Bundle

final class FrontController extends AbstractController
{
    /**
     * 1. ÉVÉNEMENTS DISPONIBLES (Page d'accueil du Citoyen)
     */
    #[Route('/front', name: 'app_front')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $events = $evenementRepository->findBy([], ['dateHeure' => 'DESC']);

        return $this->render('front/index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * 2. PARTICIPER (Logic m-separé 3al Admin)
     */
    #[Route('/participer/{id}', name: 'app_participer_event', methods: ['POST'])]
    public function participer(int $id, Request $request, EvenementRepository $repo, EntityManagerInterface $em, NotificationService $notifService): Response
    {
        $event = $repo->find($id);
        $nomCitoyen = $request->request->get('nomCitoyen');

        if ($event && $nomCitoyen) {
            $participation = new Participation();
            $participation->setEvenement($event);
            $participation->setNomCitoyen($nomCitoyen);
            $participation->setDateInscription(new \DateTime()); 

            $em->persist($participation);
            $em->flush();

            // --- ISLAH: BUNDLE NOTIFICATION ---
            // L-Admin d-ouslou alerte f'el Mailtrap d-toul mel Front!
            $notifService->notifyAdmin(
                "Nouvelle Inscription Front", 
                "Le citoyen " . $nomCitoyen . " s'est inscrit à l'action: " . $event->getTitle()
            );

            $this->addFlash('success', 'Félicitations ! Votre participation est confirmée.');
        } else {
            $this->addFlash('danger', 'Erreur lors de l\'inscription.');
        }

        // Dima yarja3 lel Front mte3ou
        return $this->redirectToRoute('app_front');
    }

    /**
     * 3. MES ACTIONS (Recherche Citoyen)
     */
    #[Route('/mes-actions', name: 'app_mes_actions')]
    public function mesActions(ParticipationRepository $participationRepository, Request $request): Response
    {
        $nomCitoyen = $request->query->get('nom'); 
        $mesParticipations = $nomCitoyen ? $participationRepository->findBy(['nomCitoyen' => $nomCitoyen]) : [];

        return $this->render('front/mes_actions.html.twig', [
            'participations' => $mesParticipations,
            'nom' => $nomCitoyen
        ]);
    }

    /**
     * 4. ESPACE ORGANISATEUR (Gestion)
     */
    #[Route('/organisateur/mes-actions', name: 'app_organisateur_index')]
    public function organisateurIndex(EvenementRepository $repo, Request $request): Response
    {
        $nomOrg = $request->query->get('org');
        $events = $nomOrg ? $repo->findBy(['nomOrganisateur' => $nomOrg]) : [];

        return $this->render('front/organisateur_index.html.twig', [
            'evenements' => $events,
            'nomOrg' => $nomOrg
        ]);
    }

    #[Route('/organisateur/modifier/{id}', name: 'app_organisateur_edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre action a été modifiée !');
            return $this->redirectToRoute('app_organisateur_index');
        }

        return $this->render('front/organisateur_edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/organisateur/details/{id}', name: 'app_organisateur_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('front/organisateur_show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/organisateur/supprimer/{id}', name: 'app_organisateur_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
            $this->addFlash('success', 'Événement supprimé !');
        }
        return $this->redirectToRoute('app_organisateur_index');
    }

    #[Route('/meteo-details', name: 'app_meteo_details')]
public function meteoDetails(): Response
{
    return $this->render('front/meteo_details.html.twig');
}

#[Route('/mes-badges', name: 'app_mes_badges')]
    public function mesBadges(ParticipationRepository $participationRepository, Request $request): Response
    {
        // Njibou el ism mel barre de recherche (url?nom=Ahmed)
        $nomCitoyen = $request->query->get('nom'); 
        
        // Njibou el participations mta3 el ism hatha bedhabt
        $mesParticipations = $nomCitoyen ? $participationRepository->findBy(['nomCitoyen' => $nomCitoyen]) : [];

        return $this->render('front/mes_badges.html.twig', [
            'participations' => $mesParticipations,
            'nom' => $nomCitoyen
        ]);
    }
}