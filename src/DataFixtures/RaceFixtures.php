<?php

namespace App\DataFixtures;

use App\Entity\Race;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RaceFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $races = [
            "ABYSSIN",
            "AMERICAN BOBTAIL",
            "AMERICAN CURL",
            "AMERICAN SHORTHAIR ET WIREHAIR",
            "ANGORA TURC",
            "BALINAIS ET MANDARIN",
            "BENGAL",
            "BOMBAY ET BURMESE AMERICAN",
            "BRITISH",
            "BURMESE ANGLAIS",
            "BURMILLA ET ASIAN",
            "CELESTE SHORTHAIR ET LONGHAIR",
            "CEYLAN",
            "CHARTREUX",
            "CHAUSIE",
            "CORNISH REX",
            "DEVON REX",
            "DONSKOY",
            "EUROPEAN SHORTHAIR",
            "GERMAN REX",
            "HAVANA BROWN",
            "JAPANESE BOBTAIL",
            "KORAT",
            "KURILIAN BOBTAIL",
            "LA PERM",
            "LYKOI",
            "MAINE COON",
            "MANX ET CYMRIC",
            "MAU EGYPTIEN",
            "MUNCHKIN",
            "NORVEGIEN",
            "OCICAT",
            "ORIENTAL",
            "PERSAN",
            "PETERBALD",
            "PIXIE BOB",
            "RAGDOLL",
            "RUSSE ET NEBELUNG",
            "SACRE DE BIRMANIE",
            "SAVANAH",
            "SCOTTISH ET HIGHLAND",
            "SELKIRK REX",
            "SIAMOIS",
            "SIBERIEN",
            "SINGAPURA",
            "SNOWSHOE",
            "SOKOKE",
            "SOMALI",
            "SPHYNX",
            "THAI",
            "TONKINOIS",
            "TOYGER",
            "TURC DU LAC DE VAN",
            "YORK CHOCOLAT"
        ];
        foreach ($races as $raceTitle) {
            $race = new Race();
            $race->setTitle($raceTitle);
            $manager->persist($race);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ColorFixtures::class,
        ];
    }
}
