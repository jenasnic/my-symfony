<?php

namespace App\DataFixtures;

use App\Enum\ReferenceValueListEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nodevo\ReferenceBundle\Entity\ReferenceValue;

class ReferenceValueFixtures extends Fixture
{
    public const CITIES = [
        'Bordeaux',
        'Lille',
        'Lyon',
        'Marseille',
        'Montpellier',
        'Paris',
        'Toulouse',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CITIES as $city) {
            $manager->persist(new ReferenceValue(ReferenceValueListEnum::CITY->name, $city));
        }

        $manager->flush();
    }
}
