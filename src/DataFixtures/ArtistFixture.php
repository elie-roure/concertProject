<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixture extends Fixture
{
    public const firstname = ["David", "Elie", "Axel", "Julien", "Clement", "Ylona"];
    public const lastname = ["Washington", "Churchill", "Bush", "Nixon", "Lenine", "Gorbatchev"];

    public const ARTIST_REFERENCE = 'artist_';

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 20; $i++) {
            $a1 = new Artist();
            $name = self::firstname[rand(0,5)] . " " . self::lastname[rand(0,5)];
            $a1->setName($name);
            $sceneName = $name . "_Scene" ;
            $a1->setSceneName($sceneName);

            $manager->persist($a1);
            $this->addReference(self::ARTIST_REFERENCE . $i, $a1);

        }
        $manager->flush();
    }
}
