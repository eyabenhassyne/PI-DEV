<?php

namespace App\EventSubscriber;

use App\Repository\EvenementRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $evenementRepository;
    private $router;

    public function __construct(EvenementRepository $repo, UrlGeneratorInterface $router)
    {
        $this->evenementRepository = $repo;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // Nesta3mlou el constanta mta3 el bundle s7i7a
            'calendar.set_data' => 'onCalendarSetData', 
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Njibou el événements mel base
        $evenements = $this->evenementRepository->findAll();

        foreach ($evenements as $ev) {
            // --- EL ISLAH HNA: Thabbet f'esma el getters ---
            // Nasta3mlou getTitle() w getDateHeure() kima f'el Entity mte3ek
            $eventCalendar = new Event(
                $ev->getTitle(), // Mouch getTitre()
                $ev->getDateHeure() // Mouch getDateDebut()
            );

            // Ken ma 3andekch dateFin, FullCalendar yesta3mel dateHeure + 1h b'el default
            if (method_exists($ev, 'getDateFin') && $ev->getDateFin()) {
                $eventCalendar->setEnd($ev->getDateFin());
            }

            $eventCalendar->setOptions([
                'backgroundColor' => '#2f6b4f',
                'borderColor' => '#2f6b4f',
                'textColor' => 'white',
            ]);
            
            // Link lel détails
            $eventCalendar->addOption('url', $this->router->generate('app_evenement_show', [
                'id' => $ev->getId(),
            ]));

            $calendar->addEvent($eventCalendar);
        }
    }
}