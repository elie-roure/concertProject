<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $concert = new Concert();
        $concert->setName("Concert1");
        $concert->setDate(\DateTime::createFromFormat("d/m/Y", "23/10/2022"));
        $concert->setCapacity(500);
        $concert->addBand($this->getReference(BandFixture::BAND_REFERENCE . "1"));
        $concert->addBand($this->getReference(BandFixture::BAND_REFERENCE . "2"));
        $concert->setVenue($this->getReference(VenueFixture::VENUE_REFERENCE . "SalleA"));
        $manager->persist($concert);

        $concert2 = new Concert();
        $concert2->setName("Concert2");
        $concert2->setDate(\DateTime::createFromFormat("d/m/Y", "23/10/2022"));
        $concert2->addBand($this->getReference(BandFixture::BAND_REFERENCE . "3"));
        $concert2->setVenue($this->getReference(VenueFixture::VENUE_REFERENCE . "SalleC"));
        $concert2->setCapacity(500);
        $manager->persist($concert2);

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
