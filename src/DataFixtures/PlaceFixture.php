<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaceFixture extends Fixture /*implements DependentFixtureInterface*/
{
    public const PLACE_REFERENCE = "place_";

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $place = new Place();
        $place->setName("Zenith");
        $place->setMaxCapacity(2500);
        $place->setAddress("Montpellier");
        //$place->addVenue($this->getReference(VenueFixture::VENUE_REFERENCE . "SalleA"));
        //$place->addVenue($this->getReference(VenueFixture::VENUE_REFERENCE . "SalleB"));
        $this->addReference(self::PLACE_REFERENCE . "Zenith", $place);



        $manager->persist($place);

        $place2 = new Place();
        $place2->setName("Arena");
        $place2->setMaxCapacity(5000);
        $place2->setAddress("Montpellier");
        //$place2->addVenue($this->getReference(VenueFixture::VENUE_REFERENCE . "SalleC"));
        $this->addReference(self::PLACE_REFERENCE . "Arena", $place2);

        $manager->persist($place2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VenueFixture::class,
        ];
    }
}
