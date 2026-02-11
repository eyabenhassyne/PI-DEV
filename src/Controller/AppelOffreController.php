<?php

namespace App\Controller;

use App\Entity\AppelOffre;
use App\Form\AppelOffreType;
use App\Repository\AppelOffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/valorisateur/appels')]
class AppelOffreController extends AbstractController
{
    #[Route('', name: 'val_appel_index', methods: ['GET'])]
    public function index(Request $request, AppelOffreRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        $q = (string) $request->query->get('q', '');
        $sort = (string) $request->query->get('sort', 'createdAt');
        $dir = (string) $request->query->get('dir', 'DESC');

        $appels = $repo->searchForValorisateur($q, $sort, $dir);

        return $this->render('valorisateur/appel_offre/index.html.twig', [
            'appels' => $appels,
            'q' => $q,
            'sort' => $sort,
            'dir' => $dir,
        ]);
    }

    #[Route('/new', name: 'val_appel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        $appel = new AppelOffre();
        $form = $this->createForm(AppelOffreType::class, $appel);
        $form->handleRequest($request);

        // ✅ Toute la validation dates est côté serveur via Entity + FormType
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($appel);
            $em->flush();

            $this->addFlash('success', "Appel d'offre créé.");
            return $this->redirectToRoute('val_appel_index');
        }

        return $this->render('valorisateur/appel_offre/new.html.twig', [
            'appel' => $appel,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'val_appel_show', methods: ['GET'])]
    public function show(AppelOffre $appel): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        return $this->render('valorisateur/appel_offre/show.html.twig', [
            'appel' => $appel,
        ]);
    }

    #[Route('/{id}/edit', name: 'val_appel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AppelOffre $appel, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        $form = $this->createForm(AppelOffreType::class, $appel);
        $form->handleRequest($request);

        // ✅ Toute la validation dates est côté serveur via Entity + FormType
        if ($form->isSubmitted() && $form->isValid()) {
            $appel->setUpdatedAt(new \DateTimeImmutable());
            $em->flush();

            $this->addFlash('success', "Appel d'offre mis à jour.");
            return $this->redirectToRoute('val_appel_show', ['id' => $appel->getId()]);
        }

        return $this->render('valorisateur/appel_offre/edit.html.twig', [
            'appel' => $appel,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'val_appel_delete', methods: ['POST'])]
    public function delete(Request $request, AppelOffre $appel, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        if ($this->isCsrfTokenValid('delete_appel_' . $appel->getId(), (string) $request->request->get('_token'))) {
            $em->remove($appel);
            $em->flush();
            $this->addFlash('success', "Appel d'offre supprimé.");
        }

        return $this->redirectToRoute('val_appel_index');
    }
}
