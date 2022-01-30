<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertFixture extends Fixture implements DependentFixtureInterface
{
    public const festival = ["Meuh Folle", "Vieille Charrue", "Musilac", "Sun Ska", "Ventilo'Fest"];
    public const Date = ["Meuh Folle", "Vieille Charrue", "Musilac", "Sun Ska", "Ventilo'Fest"];

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 15; $i++) {
            $concert = new Concert();
            $name = self::festival[rand(0,4)];
            $concert->setName($name);
            $date = rand(1,31) ."/". rand(1,12) . "/" .rand(2018,2025);
            $concert->setDate(\DateTime::createFromFormat("d/m/Y", $date));
            $concert->setCapacity(rand(1000,5000));

            for ($j=0; $j < rand(1,5); $j++) {
                $concert->addBand($this->getReference(BandFixture::BAND_REFERENCE . rand(0,9)));
            }


            $concert->setVenue($this->getReference(VenueFixture::VENUE_REFERENCE .  rand(0,5)));

            $manager->persist($concert);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            BandFixture::class,
            VenueFixture::class,
        ];
    }
}
