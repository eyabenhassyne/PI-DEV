<?php

namespace App\Controller;

use App\Entity\Recompense;
use App\Form\RecompenseType;
use App\Repository\PartenaireRepository;
use App\Repository\RecompenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/recompenses')]
#[IsGranted('ROLE_ADMIN')]
class RecompenseController extends AbstractController
{
    #[Route('/', name: 'recompense_index', methods: ['GET'])]
    public function index(RecompenseRepository $repo): Response
    {
        return $this->render('admin/recompense/index.html.twig', [
            'items' => $repo->findAllWithPartenaire(),
        ]);
    }

    #[Route('/new', name: 'recompense_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        PartenaireRepository $partRepo
    ): Response {
        $r = new Recompense();

        // ✅ Si on vient depuis la fiche partenaire : /admin/recompenses/new?partenaire=ID
        $pid = $request->query->getInt('partenaire');
        if ($pid > 0) {
            $p = $partRepo->find($pid);
            if ($p) {
                $r->setPartenaire($p);
            }
        }

        $form = $this->createForm(RecompenseType::class, $r);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($r);
            $em->flush();

            $this->addFlash('success', 'Récompense créée ✅');

            // ✅ Retour intelligent : si partenaire choisi -> fiche partenaire
            $partenaire = $r->getPartenaire();
            if ($partenaire) {
                return $this->redirectToRoute('partenaire_show', [
                    'id' => $partenaire->getId(),
                ], Response::HTTP_SEE_OTHER);
            }

            return $this->redirectToRoute('recompense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/recompense/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'recompense_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Recompense $recompense): Response
    {
        return $this->render('admin/recompense/show.html.twig', [
            'r' => $recompense,
        ]);
    }

    #[Route('/{id}/edit', name: 'recompense_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, Recompense $recompense, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RecompenseType::class, $recompense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Récompense modifiée ✅');

            $partenaire = $recompense->getPartenaire();
            if ($partenaire) {
                return $this->redirectToRoute('partenaire_show', [
                    'id' => $partenaire->getId(),
                ], Response::HTTP_SEE_OTHER);
            }

            return $this->redirectToRoute('recompense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/recompense/edit.html.twig', [
            'form' => $form->createView(),
            'r' => $recompense,
        ]);
    }

    #[Route('/{id}', name: 'recompense_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Recompense $recompense, EntityManagerInterface $em): Response
    {
        $partenaire = $recompense->getPartenaire();
        $pid = $partenaire ? $partenaire->getId() : null;

        $token = (string) $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete_recompense_' . $recompense->getId(), $token)) {
            $em->remove($recompense);
            $em->flush();

            $this->addFlash('success', 'Récompense supprimée ✅');
        } else {
            $this->addFlash('danger', 'Token CSRF invalide.');
        }

        if ($pid) {
            return $this->redirectToRoute('partenaire_show', ['id' => $pid], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('recompense_index', [], Response::HTTP_SEE_OTHER);
    }
}
