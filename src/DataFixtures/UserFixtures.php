<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setPseudo('Deb');
        $user->setEmail('example@domain.com');
        $user->setRoles(['ROLE_USER']);
        $user->setLocalisation('Paris');
        $user->setPicture('examplePictureUrl');
        $user->setPlainPassword('examplePass');
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setPseudo($this->faker->userName());
            $user->setEmail($this->faker->safeEmail());
            $user->setRoles(['ROLE_USER']);
            $user->setLocalisation($this->faker->city());
            $user->setPicture($this->faker->imageUrl());
            $user->setPlainPassword('password');

            $manager->persist($user);
        }

        $manager->flush();
    }
}
