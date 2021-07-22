<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $book1 = new Book();
        $book1->setAuthor('J.R.R Tolkien');
        $book1->setTitle('Lord of the rings');
        $this->addReference('book1', $book1);
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setAuthor('J.R.R Tolkien');
        $book2->setTitle('Silmarillon');
        $this->addReference('book2', $book2);
        $manager->persist($book2);

        $book3 = new Book();
        $book3->setAuthor('J.R.R Tolkien');
        $book3->setTitle('Sons of Hurin');
        $this->addReference('book3', $book3);
        $manager->persist($book3);

        $manager->flush();
    }
}
