<?php

namespace App\Controller;

use App\Entity\Campagne;
use App\Entity\Participation;
use App\Repository\CampagneRepository;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/campagnes')]
class CampagneController extends AbstractController
{
    #[Route('/', name: 'campagne_index', methods: ['GET'])]
    public function index(CampagneRepository $repo): Response
    {
        return $this->render('campagne/index.html.twig', [
            'items' => $repo->findBy([], ['id' => 'DESC']),
        ]);
    }

    #[Route('/my', name: 'campagne_my', methods: ['GET'])]
    public function my(ParticipationRepository $pRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        return $this->render('campagne/my.html.twig', [
            'items' => $pRepo->findMyActive($user),
        ]);
    }

    #[Route('/{id}', name: 'campagne_show', methods: ['GET'])]
    public function show(Campagne $campagne, ParticipationRepository $pRepo): Response
    {
        $joined = false;
        if ($this->getUser()) {
            $joined = $pRepo->isUserActiveInCampagne($this->getUser(), $campagne);
        }

        return $this->render('campagne/show.html.twig', [
            'c' => $campagne,
            'joined' => $joined,
        ]);
    }

    #[Route('/{id}/join', name: 'campagne_join', methods: ['POST'])]
    public function join(
        Request $request,
        Campagne $campagne,
        ParticipationRepository $pRepo,
        EntityManagerInterface $em
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$this->isCsrfTokenValid('join_campagne_'.$campagne->getId(), (string)$request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
        }

        if ($campagne->getStatut() !== Campagne::STATUT_ACTIVE) {
            $this->addFlash('error', "Cette campagne n'est pas active.");
            return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
        }

        $user = $this->getUser();
        $existing = $pRepo->findOneByUserAndCampagne($user, $campagne);

        // déjà actif
        if ($existing && $existing->getStatut() === Participation::STATUT_ACTIF) {
            $this->addFlash('warning', 'Vous êtes déjà inscrit à cette campagne.');
            return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
        }

        // réactiver une ancienne participation
        if ($existing && $existing->getStatut() === Participation::STATUT_QUITTE) {
            $existing->setStatut(Participation::STATUT_ACTIF);
            $existing->setLeftAt(null);
            $existing->setJoinedAt(new \DateTimeImmutable());
            $em->flush();

            $this->addFlash('success', 'Vous avez rejoint la campagne ✅');
            return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
        }

        // nouvelle participation
        $p = new Participation();
        $p->setUser($user);
        $p->setCampagne($campagne);

        $em->persist($p);
        $em->flush();

        $this->addFlash('success', 'Vous avez rejoint la campagne ✅');
        return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
    }

    #[Route('/{id}/leave', name: 'campagne_leave', methods: ['POST'])]
    public function leave(
        Request $request,
        Campagne $campagne,
        ParticipationRepository $pRepo,
        EntityManagerInterface $em
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$this->isCsrfTokenValid('leave_campagne_'.$campagne->getId(), (string)$request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
        }

        $user = $this->getUser();
        $existing = $pRepo->findOneByUserAndCampagne($user, $campagne);

        if (!$existing || $existing->getStatut() !== Participation::STATUT_ACTIF) {
            $this->addFlash('warning', "Vous n'êtes pas inscrit à cette campagne.");
            return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
        }

        $existing->setStatut(Participation::STATUT_QUITTE);
        $existing->setLeftAt(new \DateTimeImmutable());
        $em->flush();

        $this->addFlash('success', 'Vous avez quitté la campagne ✅');
        return $this->redirectToRoute('campagne_show', ['id' => $campagne->getId()]);
    }
}
