<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaceFixture extends Fixture /*implements DependentFixtureInterface*/
{
    public const PLACE_REFERENCE = "place_";

    public const ville = ["Ales", "Karez", "Aix Les Bains", "Vertheuil", "Arc 1800"];
    public const nom = ["Parc Expo", "Champs", "Lac", "Domaine de Nodris", "Le Charvet"];

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 5; $i++) {
            $place = new Place();
            $place->setName(self::nom[$i]);
            $place->setAddress(self::ville[$i]);
            $place->setMaxCapacity(rand(1000,5000));
            $this->addReference(self::PLACE_REFERENCE . $i, $place);

            $manager->persist($place);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VenueFixture::class,
        ];
    }
}
