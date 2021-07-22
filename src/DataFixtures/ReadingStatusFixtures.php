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
       $readingStatus = new ReadingStatus();
       $readingStatus->setStatus('Terminé');
       $readingStatus->setReadingList($this->getReference('readingList1'));
       $readingStatus->setBook($this->getReference('book1'));
       $manager->persist($readingStatus);

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
