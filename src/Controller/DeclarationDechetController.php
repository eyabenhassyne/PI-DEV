<?php

namespace App\Controller;

use App\Entity\DeclarationDechet;
use App\Form\DeclarationDechetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class DeclarationDechetController extends AbstractController
{
    #[Route('/citoyen/declarations', name: 'citoyen_declarations')]
    public function index(EntityManagerInterface $em): Response
    {
        $declarations = $em->getRepository(DeclarationDechet::class)->findBy([], ['createdAt' => 'DESC']);

        return $this->render('declaration_dechet/index.html.twig', [
            'declarations' => $declarations,
        ]);
    }

    #[Route('/citoyen/declaration/new', name: 'declaration_dechet_new')]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {

        $declaration = new DeclarationDechet();

        $form = $this->createForm(DeclarationDechetType::class, $declaration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $declaration->setStatut('en_attente');
            $declaration->setCreatedAt(new \DateTime());

            $photoFile = $form->get('photoFile')->getData();

            if ($photoFile) {

                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

                try {
                    $photoFile->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads/dechets',
                        $newFilename
                    );
                } catch (FileException $e) {
                    dd($e->getMessage());
                }

                $declaration->setPhoto($newFilename);
            }

            $em->persist($declaration);
            $em->flush();

            $this->addFlash('success', 'Votre déclaration a été enregistrée avec succès.');

            return $this->redirectToRoute('citoyen_declarations');
        }

        return $this->render('declaration_dechet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
