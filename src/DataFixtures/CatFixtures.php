<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $manager->getRepository(User::class)->findOneByEmail('example@domain.com');

        if (!$user) {
            throw new \Exception('User not found!');
        }

        $cat = new Cat();
        $cat->setName('Pipa');
        $cat->setRace('Angora');
        $cat->setAge(3);
        $cat->setColor('Black');
        $cat->setLocalisation('Paris');
        $cat->setPicture('example');
        $cat->setUser($user);
        $manager->persist($cat);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
