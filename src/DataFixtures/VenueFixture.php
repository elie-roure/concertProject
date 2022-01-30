<?php

namespace App\DataFixtures;

use App\Entity\Venue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VenueFixture extends Fixture implements DependentFixtureInterface
{
    public const VENUE_REFERENCE = "venue_";
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $venue = new Venue();
        $venue->setName("Salle A");
        $venue->setCapacity(1000);
        $venue->setPlace($this->getReference(PlaceFixture::PLACE_REFERENCE . "Zenith"));
        $manager->persist($venue);
        $this->addReference(self::VENUE_REFERENCE . "SalleA", $venue);

        $venue2 = new Venue();
        $venue2->setName("Salle B");
        $venue2->setCapacity(1500);
        $venue2->setPlace($this->getReference(PlaceFixture::PLACE_REFERENCE . "Zenith"));
        $manager->persist($venue2);
        $this->addReference(self::VENUE_REFERENCE . "SalleB", $venue2);

        $venue3 = new Venue();
        $venue3->setName("Salle C");
        $venue3->setCapacity(2500);
        $venue3->setPlace($this->getReference(PlaceFixture::PLACE_REFERENCE . "Arena"));
        $manager->persist($venue3);
        $this->addReference(self::VENUE_REFERENCE . "SalleC", $venue3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PlaceFixture::class,
        ];
    }
}
