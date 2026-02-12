<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route('', name: 'app_user_index', methods: ['GET'])]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $q = trim((string) $request->query->get('q', ''));

        $users = $q !== ''
            ? $userRepository->search($q)
            : $userRepository->findBy([], ['id' => 'DESC']);

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
            'q' => $q,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = new User();

        $form = $this->createForm(UserType::class, $user, ['is_edit' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plainPassword = (string) $form->get('password')->getData();
            $user->setPassword($hasher->hashPassword($user, $plainPassword));

            // ✅ rôles auto selon type
            $this->applyRolesFromType($user);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Utilisateur créé avec succès ✅');
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        User $user,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(UserType::class, $user, ['is_edit' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ✅ ne change password que si rempli
            $plainPassword = (string) $form->get('password')->getData();
            if ($plainPassword !== '') {
                $user->setPassword($hasher->hashPassword($user, $plainPassword));
            }

            // ✅ rôles auto si type modifié
            $this->applyRolesFromType($user);

            $em->flush();

            $this->addFlash('success', 'Utilisateur modifié ✅');
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $token = (string) $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete' . $user->getId(), $token)) {
            $em->remove($user);
            $em->flush();
            $this->addFlash('success', 'Utilisateur supprimé ✅');
        } else {
            $this->addFlash('danger', 'Token CSRF invalide ❌');
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    private function applyRolesFromType(User $user): void
    {
        $type = $user->getType();

        if ($type === User::TYPE_ADMIN) {
            $user->setRoles(['ROLE_ADMIN']);
            return;
        }

        if ($type === User::TYPE_VALORIZER) {
            $user->setRoles(['ROLE_VALORIZER']);
            return;
        }

        // citoyen
        $user->setRoles(['ROLE_USER']);
    }
}
