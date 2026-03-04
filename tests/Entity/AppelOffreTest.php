<?php

namespace App\Tests\Entity;

use App\Entity\AppelOffre;
use App\Entity\ReponseOffre;
use PHPUnit\Framework\TestCase;

final class AppelOffreTest extends TestCase
{
    public function testIsExpiredReturnsFalseWhenNoDeadlineIsSet(): void
    {
        $appelOffre = new AppelOffre();

        self::assertFalse($appelOffre->isExpired(new \DateTimeImmutable('2026-03-01 10:00:00')));
    }

    public function testIsExpiredReturnsTrueWhenDeadlineIsInPast(): void
    {
        $appelOffre = new AppelOffre();
        $appelOffre->setDateLimite(new \DateTime('2026-02-28 10:00:00'));

        self::assertTrue($appelOffre->isExpired(new \DateTimeImmutable('2026-03-01 10:00:00')));
    }

    public function testAddReponseOffreSetsOwningSideAndPreventsDuplicates(): void
    {
        $appelOffre = new AppelOffre();
        $reponse = new ReponseOffre();

        $appelOffre->addReponseOffre($reponse);
        $appelOffre->addReponseOffre($reponse);

        self::assertCount(1, $appelOffre->getReponseOffres());
        self::assertSame($appelOffre, $reponse->getAppelOffre());
    }

    public function testRemoveReponseOffreClearsOwningSide(): void
    {
        $appelOffre = new AppelOffre();
        $reponse = new ReponseOffre();

        $appelOffre->addReponseOffre($reponse);
        $appelOffre->removeReponseOffre($reponse);

        self::assertCount(0, $appelOffre->getReponseOffres());
        self::assertNull($reponse->getAppelOffre());
    }
}
