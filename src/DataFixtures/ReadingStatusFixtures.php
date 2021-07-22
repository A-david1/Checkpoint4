<?php

namespace App\DataFixtures;

use App\Entity\ReadingList;
use App\Entity\ReadingStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReadingStatusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $readingStatus1 = new ReadingStatus();
       $readingStatus1->setStatus('Terminé');
       $readingStatus1->setReadingList($this->getReference('readingList1'));
       $readingStatus1->setBook($this->getReference('book1'));
       $readingStatus1->setAddedAt(new \DateTimeImmutable());
       $readingStatus1->setFinishedAt(new \DateTimeImmutable());
       $readingStatus1->setStartedAt(new \DateTimeImmutable());
       $manager->persist($readingStatus1);

        $readingStatus2 = new ReadingStatus();
        $readingStatus2->setStatus('En cours');
        $readingStatus2->setReadingList($this->getReference('readingList1'));
        $readingStatus2->setBook($this->getReference('book2'));
        $readingStatus2->setAddedAt(new \DateTimeImmutable());
        $readingStatus2->setFinishedAt(new \DateTimeImmutable());
        $readingStatus2->setStartedAt(new \DateTimeImmutable());
        $manager->persist($readingStatus2);

        $readingStatus3 = new ReadingStatus();
        $readingStatus3->setStatus('A lire');
        $readingStatus3->setReadingList($this->getReference('readingList1'));
        $readingStatus3->setBook($this->getReference('book3'));
        $readingStatus3->setAddedAt(new \DateTimeImmutable());
        $readingStatus3->setFinishedAt(new \DateTimeImmutable());
        $readingStatus3->setStartedAt(new \DateTimeImmutable());
        $manager->persist($readingStatus3);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ReadingListFixtures::class,
            BookFixtures::class,
        ];

    }
}
