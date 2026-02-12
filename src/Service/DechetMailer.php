<?php

namespace App\Service;

use App\Entity\Dechet;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

final class DechetMailer
{
    public function __construct(private MailerInterface $mailer) {}

    public function sendDechetValide(Dechet $dechet): void
    {
        $user = $dechet->getUser();
        if (!$user || !$user->getEmail()) return;

        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@wastewise.tn', 'WasteWise TN'))
            ->to((string) $user->getEmail())
            ->subject('✅ Déclaration validée - EcoPoints attribués')
            ->htmlTemplate('emails/dechet_valide.html.twig')
            ->context([
                'dechet' => $dechet,
                'user'   => $user,
            ]);

        $this->mailer->send($email);
    }

    public function sendDechetRefuse(Dechet $dechet): void
    {
        $user = $dechet->getUser();
        if (!$user || !$user->getEmail()) return;

        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@wastewise.tn', 'WasteWise TN'))
            ->to((string) $user->getEmail())
            ->subject('❌ Déclaration refusée')
            ->htmlTemplate('emails/dechet_refuse.html.twig')
            ->context([
                'dechet' => $dechet,
                'user'   => $user,
            ]);

        $this->mailer->send($email);
    }
}
