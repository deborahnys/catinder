<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ColorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $colors = [
            'Noir',
            'Blanc',
            'Bleu',
            'Rouge',
            'Crème'
        ];

        foreach ($colors as $colorTitle) {
            $color = new Color();
            $color->setTitle($colorTitle);
            $manager->persist($color);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }   
}
