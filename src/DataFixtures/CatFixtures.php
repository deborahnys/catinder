<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\Color;
use App\Entity\Race;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CatFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->faker->seed(1234);
    }
    public function load(ObjectManager $manager)
    {
        $races = $manager->getRepository(Race::class)->findAll();
        $colors = $manager->getRepository(Color::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();

        if (!$colors) {
            throw new \Exception('No colors found in the database! Add some colors before trying to create cats.');
        }
        if (!$users) {
            throw new \Exception('No users found in the database! Add some users before trying to create cats.');
        }

        if (!$races) {
            throw new \Exception('No races found in the database! Add some races before trying to create cats.');
        }

        for ($i = 0; $i < 200; $i++) {
            $cat = new Cat();
            $cat->setName($this->faker->name);
            $cat->setAge($this->faker->numberBetween(1, 15));
            $cat->setLocalisation($this->faker->city);
            $cat->setPicture($this->faker->imageUrl(640, 480, 'cats'));

            $randomRace = $races[mt_rand(0, count($races) - 1)];
            $randomColor = $colors[mt_rand(0, count($colors) - 1)];
            $randomUser = $users[mt_rand(0, count($users) - 1)];
            $cat->setRace($randomRace);
            $cat->setColor($randomColor);
            $cat->setUser($randomUser);

            $manager->persist($cat);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ColorFixtures::class,
            RaceFixtures::class,
        ];
    }
}
