<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setAge('36');
        $user->setLocalisation('Paris');
        $user->setPicture('example');
        $user->setPseudo('luffy');
        $manager->persist($user);
        $manager->flush();
    }
}
