<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class GithubAuthenticator extends OAuth2Authenticator
{
    private $clientRegistry;
    private $em;
    private $router;

    public function __construct(
        ClientRegistry $clientRegistry,
        EntityManagerInterface $em,
        RouterInterface $router
    ) {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'connect_github_check';
    }

    public function authenticate(Request $request): Passport
    {
        $client = $this->clientRegistry->getClient('github');
        $accessToken = $this->fetchAccessToken($client);

        $githubUser = $client->fetchUserFromToken($accessToken);

        // identifiant fiable même si email privé
        $githubId = (string) $githubUser->getId();
        $email = $githubUser->getEmail(); // peut être null

        return new SelfValidatingPassport(
            new UserBadge('github_'.$githubId, function () use ($githubId, $email) {

                $repo = $this->em->getRepository(User::class);

                $user = null;

                // si email existe → chercher par email
                if ($email) {
                    $user = $repo->findOneBy(['email' => $email]);
                }

                // sinon créer utilisateur
                if (!$user) {
                    $user = new User();

                    if ($email) {
                        $user->setEmail($email);
                    } else {
                        // fallback si email privé
                        $user->setEmail('github_'.$githubId.'@example.local');
                    }

                    $user->setRoles(['ROLE_USER']);
                    $this->em->persist($user);
                    $this->em->flush();
                }

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, $token, string $firewallName): ?RedirectResponse
    {
        return new RedirectResponse($this->router->generate('dashboard'));
    }

    public function onAuthenticationFailure(Request $request, \Throwable $exception): ?RedirectResponse
    {
        return new RedirectResponse($this->router->generate('app_login'));
    }
}
