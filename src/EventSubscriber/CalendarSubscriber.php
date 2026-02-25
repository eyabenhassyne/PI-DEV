<?php

namespace App\EventSubscriber;

use App\Repository\EvenementRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvents; // <--- Jarrab hédhi 
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
        // Ken mezelet el ghalta f'el ligne hédhi, badelha b-string direct:
        return [
            'calendar.set_data' => 'onCalendarSetData', 
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $evenements = $this->evenementRepository->findAll();

        foreach ($evenements as $ev) {
            $eventCalendar = new Event(
                $ev->getTitre(), 
                $ev->getDateDebut(),
                $ev->getDateFin()
            );

            $eventCalendar->setOptions([
                'backgroundColor' => '#2f6b4f',
                'borderColor' => '#2f6b4f',
                'textColor' => 'white',
            ]);
            
            // Thabbet elli 'app_evenement_show' mawjouda f'el controller mte3ek
            $eventCalendar->addOption('url', $this->router->generate('app_evenement_show', [
                'id' => $ev->getId(),
            ]));

            $calendar->addEvent($eventCalendar);
        }
    }
}