<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenaireType;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/partenaires')]
#[IsGranted('ROLE_ADMIN')]
class PartenaireController extends AbstractController
{
    #[Route('/', name: 'partenaire_index', methods: ['GET'])]
    public function index(PartenaireRepository $repo): Response
    {
        return $this->render('admin/partenaire/index.html.twig', [
            'items' => $repo->findBy([], ['id' => 'DESC']),
        ]);
    }

    #[Route('/new', name: 'partenaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $p = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $p);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($p);
            $em->flush();

            $this->addFlash('success', 'Partenaire créé ✅');

            return $this->redirectToRoute('partenaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/partenaire/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'partenaire_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Partenaire $partenaire): Response
    {
        return $this->render('admin/partenaire/show.html.twig', [
            'p' => $partenaire,
            'recompenses' => $partenaire->getRecompenses(),
        ]);
    }

    #[Route('/{id}/edit', name: 'partenaire_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, Partenaire $partenaire, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Partenaire modifié ✅');

            return $this->redirectToRoute('partenaire_show', [
                'id' => $partenaire->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/partenaire/edit.html.twig', [
            'form' => $form->createView(),
            'p' => $partenaire,
        ]);
    }

    #[Route('/{id}', name: 'partenaire_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Partenaire $partenaire, EntityManagerInterface $em): Response
    {
        $token = (string) $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete_partenaire_' . $partenaire->getId(), $token)) {
            $em->remove($partenaire);
            $em->flush();

            $this->addFlash('success', 'Partenaire supprimé ✅');
        } else {
            $this->addFlash('danger', 'Token CSRF invalide.');
        }

        return $this->redirectToRoute('partenaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
