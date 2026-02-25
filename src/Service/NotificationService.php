<?php

namespace App\Service;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class NotificationService
{
    private $mailer;
    private $em;

    // 1. EL ISLAH: Lezem t-zid EntityManagerInterface hna bech t-sajjel f'el base
    public function __construct(MailerInterface $mailer, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->em = $em;
    }

    // 1. Notification: Excellent Status
    public function sendExcellentStatus(string $userEmail)
    {
        $email = (new Email())
            ->from('system@wastewise.tn')
            ->to($userEmail)
            ->subject('Félicitations : Statut Excellent !')
            ->html('<h1>Bravo !</h1><p>Votre engagement écologique est exemplaire. Vous êtes passé au statut <b>Excellent</b> !</p>');

        $this->mailer->send($email);
    }

    // 2. Notification: Événement Annulé
    public function sendCancellation(string $userEmail, string $eventTitle)
    {
        $email = (new Email())
            ->from('admin@wastewise.tn')
            ->to($userEmail)
            ->subject('Alerte : Événement Annulé')
            ->text("Désolé, l'événement '$eventTitle' est annulé.");

        $this->mailer->send($email);
    }

    // 3. Notification Admin (Double Action: Base + Mailtrap)
    public function notifyAdmin(string $actionType, string $details)
    {
        // A. Sajjel f'el Database (Tawa d-tekhdem khater el table mawjouda)
        $notification = new Notification();
        $notification->setTitle("Alerte Système : $actionType");
        $notification->setMessage($details);
        $notification->setCreatedAt(new \DateTimeImmutable());
        $notification->setIsRead(false);

        $this->em->persist($notification);
        $this->em->flush();

        // B. Ba3th el Mail kima kount ta3mel
        $email = (new Email())
            ->from('system@wastewise.tn')
            ->to('admin@wastewise.tn')
            ->subject("Alerte Système : $actionType")
            ->html("
                <h3>Rapport d'activité</h3>
                <p><strong>Action :</strong> $actionType</p>
                <p><strong>Détails :</strong> $details</p>
                <p>Date : " . date('d/m/Y H:i') . "</p>
            ");

        $this->mailer->send($email);
    }
}