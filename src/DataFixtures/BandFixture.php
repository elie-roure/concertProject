<?php

namespace App\DataFixtures;

use App\Entity\Band;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BandFixture extends Fixture implements DependentFixtureInterface
{
    public const nom = ["Poulet", "Hyppocampe", "Vache", "Tigre", "AyeAye", "Chouette"];
    public const adj = ["Furieux", "Nocturne", "Sacré", "Demoniaque", "Terrible", "Farfelue"];
    public const style = ["Rap", "Rock", "Pop", "Slam", "Metal", "Reggae"];
    public const BAND_REFERENCE = "band_";


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 10; $i++) {
            $b1 = new Band();
            $name = self::nom[rand(0,5)] . " " . self::adj[rand(0,5)];
            $b1->setName($name);
            $b1->setStyle(self::style[rand(0,5)]);
            for ($j=0; $j < 3; $j++) {
                $b1->addArtist($this->getReference(ArtistFixture::ARTIST_REFERENCE . rand(0,19)));
            }
            $this->addReference(self::BAND_REFERENCE . $i, $b1);

            $manager->persist($b1);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArtistFixture::class,
        ];
    }
}
