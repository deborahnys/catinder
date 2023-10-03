<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CatFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cat = new Cat();
        $cat->setRace('Angora');
        $cat->setAge('3');
        $cat->setColor('Black');
        $cat->setLocalisation('Paris');
        $cat->setPicture('example');
        $manager->persist($cat);
        $manager->flush();
    }
}
