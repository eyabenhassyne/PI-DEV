<?php

namespace App\Controller;

use App\Entity\ZonePolluee;
use App\Form\ZonePollueeType;
use App\Repository\ZonePollueeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/zone-polluee')]
class ZonePollueeController extends AbstractController
{
    // LISTE (READ ALL)
    #[Route('/', name: 'app_zone_polluee_index', methods: ['GET'])]
    public function index(ZonePollueeRepository $repository): Response
    {
        $zones = $repository->findAll();
        
        return $this->render('zone_polluee/index.html.twig', [
            'zones' => $zones,
        ]);
    }

    // AJOUTER (CREATE)
    #[Route('/new', name: 'app_zone_polluee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $zone = new ZonePolluee();
        $form = $this->createForm(ZonePollueeType::class, $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($zone);
            $entityManager->flush();

            $this->addFlash('success', 'Zone polluée ajoutée avec succès !');
            return $this->redirectToRoute('app_zone_polluee_index');
        }

        return $this->render('zone_polluee/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // DÉTAILS (READ ONE)
    #[Route('/{id}', name: 'app_zone_polluee_show', methods: ['GET'])]
    public function show(ZonePolluee $zone): Response
    {
        return $this->render('zone_polluee/show.html.twig', [
            'zone' => $zone,
        ]);
    }

    // MODIFIER (UPDATE)
    #[Route('/{id}/edit', name: 'app_zone_polluee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ZonePolluee $zone, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ZonePollueeType::class, $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Zone polluée modifiée avec succès !');
            return $this->redirectToRoute('app_zone_polluee_index');
        }

        return $this->render('zone_polluee/edit.html.twig', [
            'form' => $form->createView(),
            'zone' => $zone,
        ]);
    }

    // SUPPRIMER (DELETE)
    #[Route('/{id}/delete', name: 'app_zone_polluee_delete', methods: ['POST'])]
    public function delete(Request $request, ZonePolluee $zone, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zone->getId(), $request->request->get('_token'))) {
            $entityManager->remove($zone);
            $entityManager->flush();

            $this->addFlash('success', 'Zone polluée supprimée avec succès !');
        }

        return $this->redirectToRoute('app_zone_polluee_index');
    }
}