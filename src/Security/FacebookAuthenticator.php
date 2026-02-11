<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use League\OAuth2\Client\Provider\FacebookUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class FacebookAuthenticator extends OAuth2Authenticator
{
    public function __construct(
        private ClientRegistry $clientRegistry,
        private EntityManagerInterface $em,
        private RouterInterface $router
    ) {}

    public function supports(Request $request): ?bool
    {
        // ✅ adapte si ta route callback a un autre nom
        return $request->attributes->get('_route') === 'connect_facebook_check';
    }

    public function authenticate(Request $request): Passport
    {
        $client = $this->clientRegistry->getClient('facebook');

        // ✅ récupère le token via OAuth2
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge('facebook_user', function () use ($client, $accessToken) {

                /** @var FacebookUser $fbUser */
                $fbUser = $client->fetchUserFromToken($accessToken);

                $email = $fbUser->getEmail();
                if (!$email) {
                    // Facebook peut ne pas fournir l'email si pas autorisé
                    throw new AuthenticationException("Facebook ne fournit pas l'email. Vérifie les permissions (email).");
                }

                // ✅ chercher user existant par email
                $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);

                // ✅ sinon créer un nouveau user
                if (!$user) {
                    $user = new User();
                    $user->setEmail($email);

                    // IMPORTANT: ton User a sûrement password NOT NULL => on met un password random hashé
                    // Si tu as rendu password nullable, tu peux enlever ce bloc.
                    $user->setPassword(password_hash(bin2hex(random_bytes(16)), PASSWORD_BCRYPT));

                    // ✅ mets un rôle par défaut (à adapter)
                    if (method_exists($user, 'setRoles')) {
                        $user->setRoles(['ROLE_USER']);
                    }

                    // ✅ si tu as un champ "type" dans User
                    if (method_exists($user, 'setType')) {
                        $user->setType('CITOYEN');
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
        // ✅ redirection après login social
        return new RedirectResponse($this->router->generate('app_dashboard'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?RedirectResponse
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        return new RedirectResponse($this->router->generate('app_login'));
    }
}
