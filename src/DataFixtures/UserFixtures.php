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
        $this->faker->seed(1234);
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setPseudo('admin');
        $user->setEmail('admin@catinder.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setLocalisation('Paris');
        $user->setPicture('examplePictureUrl');
        $user->setPlainPassword('admin');
        $manager->persist($user);

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setPseudo($this->faker->firstNameMale());
            $user->setEmail($this->faker->safeEmail());
            $user->setRoles(['ROLE_USER']);
            $user->setLocalisation($this->faker->city());
            $user->setPicture('https://randomuser.me/api/portraits/men/' . rand(0, 99) . '.jpg');
            $user->setPlainPassword('password');

            $manager->persist($user);
        }
        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setPseudo($this->faker->firstNameFemale());
            $user->setEmail($this->faker->safeEmail());
            $user->setRoles(['ROLE_USER']);
            $user->setLocalisation($this->faker->city());
            $user->setPicture('https://randomuser.me/api/portraits/women/' . rand(0, 99) . '.jpg');
            $user->setPlainPassword('password');
            $manager->persist($user);
        }
        $manager->flush();
    }
}
