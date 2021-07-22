<?php

namespace App\DataFixtures;

use App\Entity\ReadingList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReadingListFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $readingList1 = new ReadingList();
        $readingList1->setUser($this->getReference('user1'));
        $this->addReference('readingList1', $readingList1);
        $manager->persist($readingList1);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];

    }
}
