<?php

namespace App\Controller;

use App\Entity\DeclarationDechet;
use App\Repository\TypeDechetRepository;
use App\Repository\DeclarationDechetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function dashboard(TypeDechetRepository $typeDechetRepo, DeclarationDechetRepository $declarationRepo): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'totalTypes' => $typeDechetRepo->count([]),
            'totalDeclarations' => $declarationRepo->count([]),
            'pendingDeclarations' => $declarationRepo->count(['statut' => 'en_attente']),
        ]);
    }

    #[Route('/admin/declarations', name: 'admin_declarations')]
    public function listDeclarations(DeclarationDechetRepository $repo): Response
    {
        return $this->render('admin/declarations/index.html.twig', [
            'declarations' => $repo->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/admin/declaration/{id}/status', name: 'admin_declaration_status', methods: ['POST'])]
    public function updateStatus(DeclarationDechet $declaration, Request $request, EntityManagerInterface $em): Response
    {
        $newStatus = $request->request->get('status');
        $validStatuses = ['en_attente', 'valide', 'rejete'];

        if (in_array($newStatus, $validStatuses)) {
            $declaration->setStatut($newStatus);
            $em->flush();
            $this->addFlash('success', 'Statut mis à jour avec succès.');
        } else {
            $this->addFlash('error', 'Statut invalide.');
        }

        return $this->redirectToRoute('admin_declarations');
    }

    #[Route('/admin/declaration/{id}/delete', name: 'admin_declaration_delete', methods: ['POST'])]
    public function deleteDeclaration(DeclarationDechet $declaration, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$declaration->getId(), $request->request->get('_token'))) {
            $em->remove($declaration);
            $em->flush();
            $this->addFlash('success', 'Déclaration supprimée.');
        }

        return $this->redirectToRoute('admin_declarations');
    }
}
