<?php

namespace App\Controller;

use App\Entity\Dechet;
use App\Form\DechetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DechetController extends AbstractController
{
    #[Route('/dechet/nouveau', name: 'dechet_nouveau', methods: ['GET','POST'])]
    public function nouveau(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $dechet = new Dechet();
        $form = $this->createForm(DechetType::class, $dechet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ✅ Associer au user connecté
            $dechet->setUser($this->getUser());

            $em->persist($dechet);
            $em->flush();

            $this->addFlash('success', 'Déchet déclaré avec succès ✅');
            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('dechet/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
