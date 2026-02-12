<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class GoogleAuthenticator extends OAuth2Authenticator
{
    public function __construct(
        private ClientRegistry $clientRegistry,
        private EntityManagerInterface $em,
        private RouterInterface $router
    ) {}

    public function supports(Request $request): ?bool
    {
        // ✅ adapte si ton nom de route callback est différent
        return $request->attributes->get('_route') === 'connect_google_check';
    }

    public function authenticate(Request $request): Passport
    {
        $client = $this->clientRegistry->getClient('google');

        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge('google_user', function () use ($client, $accessToken) {

                /** @var GoogleUser $googleUser */
                $googleUser = $client->fetchUserFromToken($accessToken);

                $email = $googleUser->getEmail();
                if (!$email) {
                    throw new AuthenticationException("Google ne fournit pas l'email.");
                }

                $userRepo = $this->em->getRepository(User::class);
                $user = $userRepo->findOneBy(['email' => $email]);

                if (!$user) {
                    $user = new User();
                    $user->setEmail($email);

                    // ✅ Password random (si password NOT NULL dans DB)
                    $user->setPassword(password_hash(bin2hex(random_bytes(16)), PASSWORD_BCRYPT));

                    // ✅ rôle / type par défaut
                    if (method_exists($user, 'setRoles')) {
                        $user->setRoles(['ROLE_USER']);
                    }
                    if (method_exists($user, 'setType')) {
                        $user->setType('CITOYEN');
                    }

                    // ✅ nom/prenom si tu as ces champs
                    if (method_exists($user, 'setPrenom') && $googleUser->getFirstName()) {
                        $user->setPrenom($googleUser->getFirstName());
                    }
                    if (method_exists($user, 'setNom') && $googleUser->getLastName()) {
                        $user->setNom($googleUser->getLastName());
                    }

                    $this->em->persist($user);
                    $this->em->flush();
                }

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, $token, string $firewallName): ?RedirectResponse
    {
        return new RedirectResponse($this->router->generate('app_dashboard'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?RedirectResponse
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        return new RedirectResponse($this->router->generate('app_login'));
    }
}
