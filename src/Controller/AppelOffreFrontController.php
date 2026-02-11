<?php

namespace App\Controller;

use App\Entity\AppelOffre;
use App\Entity\Proposition;
use App\Form\PropositionType;
use App\Repository\AppelOffreRepository;
use App\Repository\PropositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/citoyen/appels')]
class AppelOffreFrontController extends AbstractController
{
    /**
     * ✅ Vérifie que l’utilisateur est bien un citoyen
     */
    private function denyUnlessCitizen(): void
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        if (!$user || !method_exists($user, 'getType')) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        // Dans ta DB: type = "CITIZEN"
        if ($user->getType() !== 'CITIZEN') {
            throw $this->createAccessDeniedException("Accès réservé aux citoyens.");
        }
    }

    #[Route('', name: 'cit_appel_index', methods: ['GET'])]
    public function index(Request $request, AppelOffreRepository $repo): Response
    {
        $this->denyUnlessCitizen();

        $q = (string) $request->query->get('q', '');
        $appels = $repo->listOpenForCitoyen($q);

        return $this->render('citoyen/appel/index.html.twig', [
            'appels' => $appels,
            'q' => $q,
        ]);
    }

    #[Route('/{id}', name: 'cit_appel_show', methods: ['GET'])]
    public function show(AppelOffre $appel): Response
    {
        $this->denyUnlessCitizen();

        return $this->render('citoyen/appel/show.html.twig', [
            'appel' => $appel,
        ]);
    }

    #[Route('/{id}/proposer', name: 'cit_appel_proposer', methods: ['GET', 'POST'])]
    public function proposer(
        Request $request,
        AppelOffre $appel,
        PropositionRepository $propRepo,
        EntityManagerInterface $em
    ): Response {
        $this->denyUnlessCitizen();

        // ✅ règle serveur: proposer seulement si ouvert + pas expiré
        if (!method_exists($appel, 'isOuvert') || !$appel->isOuvert()) {
            $this->addFlash('danger', "Cet appel d'offre n'est plus ouvert.");
            return $this->redirectToRoute('cit_appel_show', ['id' => $appel->getId()]);
        }

        $proposition = new Proposition();
        $proposition->setAppelOffre($appel);

        $form = $this->createForm(PropositionType::class, $proposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ✅ Une seule proposition par email pour cet appel (optionnel)
            $email = method_exists($proposition, 'getEmail') ? (string) $proposition->getEmail() : '';
            if ($email !== '' && $propRepo->existsEmailForAppel($appel, $email)) {
                $form->addError(new FormError("Vous avez déjà envoyé une proposition avec cet email pour cet appel."));
            } else {
                $em->persist($proposition);
                $em->flush();

                $this->addFlash('success', "Votre proposition a été envoyée.");
                return $this->redirectToRoute('cit_appel_show', ['id' => $appel->getId()]);
            }
        }

        return $this->render('citoyen/appel/proposer.html.twig', [
            'appel' => $appel,
            'form' => $form->createView(),
        ]);
    }
}
