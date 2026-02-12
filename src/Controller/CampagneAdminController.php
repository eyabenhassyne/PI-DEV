<?php

namespace App\Controller;

use App\Entity\Campagne;
use App\Form\CampagneType;
use App\Repository\CampagneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/campagnes')]
#[IsGranted('ROLE_ADMIN')]
class CampagneAdminController extends AbstractController
{
    #[Route('/', name: 'admin_campagne_index', methods: ['GET'])]
    public function index(CampagneRepository $repo): Response
    {
        return $this->render('admin/campagne/index.html.twig', [
            'items' => $repo->findBy([], ['id' => 'DESC']),
        ]);
    }

    #[Route('/new', name: 'admin_campagne_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $c = new Campagne();
        $form = $this->createForm(CampagneType::class, $c);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($c);
            $em->flush();
            $this->addFlash('success', 'Campagne créée ✅');
            return $this->redirectToRoute('admin_campagne_index');
        }

        return $this->render('admin/campagne/new.html.twig', [
            'form' => $form->createView(),
            'c' => $c,
        ]);
    }

    #[Route('/{id}', name: 'admin_campagne_show', methods: ['GET'])]
    public function show(Campagne $campagne): Response
    {
        return $this->render('admin/campagne/show.html.twig', [
            'c' => $campagne,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_campagne_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Campagne $campagne, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Campagne modifiée ✅');
            return $this->redirectToRoute('admin_campagne_show', ['id' => $campagne->getId()]);
        }

        return $this->render('admin/campagne/edit.html.twig', [
            'form' => $form->createView(),
            'c' => $campagne,
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_campagne_delete', methods: ['POST'])]
    public function delete(Request $request, Campagne $campagne, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete_campagne_'.$campagne->getId(), (string)$request->request->get('_token'))) {
            $em->remove($campagne);
            $em->flush();
            $this->addFlash('success', 'Campagne supprimée ✅');
        } else {
            $this->addFlash('error', 'Token CSRF invalide.');
        }

        return $this->redirectToRoute('admin_campagne_index');
    }
}
