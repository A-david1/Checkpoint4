<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setName('Antoine');
        $user1->setPassword($this->encoder->encodePassword($user1, 123456));
        $user1->setMail('test@gmail.com');
        $user1->setRoles(['ROLE_USER']);
        $this->addReference('user1', $user1);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setName('Jonas');
        $user2->setPassword($this->encoder->encodePassword($user1, 123456));
        $user2->setMail('test2@gmail.com');
        $user2->setRoles(['ROLE_USER']);
        $manager->persist($user2);

        $manager->flush();
    }
}
