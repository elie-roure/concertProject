<?php

namespace App\DataFixtures;

use App\Entity\Venue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VenueFixture extends Fixture implements DependentFixtureInterface
{
    public const piece = ["Cuisine", "Chambre", "Bureau", "Salon", "Salle à manger"];
    public const VENUE_REFERENCE = "venue_";
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 15; $i++) {
            $venue = new Venue();

            $name = self::piece[rand(0,4)];
            $venue->setName($name);
            $venue->setCapacity(rand(1000,5000));
            $venue->setPlace($this->getReference(PlaceFixture::PLACE_REFERENCE . rand(0,4)));
            $manager->persist($venue);
            $this->addReference(self::VENUE_REFERENCE . $i, $venue);



            $manager->persist($venue);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PlaceFixture::class,
        ];
    }
}
