<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @return UserPasswordHasherInterface
     */
    public function getHasher(): UserPasswordHasherInterface
    {
        return $this->hasher;
    }


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $u = new User();
        $email = "user" . "@gmail.com";
        $u->setEmail($email);
        $u->setFirstName("a");
        $u->setLastName("a");
        $u->setPassword(self::getHasher()->hashPassword($u, '123456'));
        $u->setRoles(array('ROLE_USER'));
        /*$sceneName = $name . "_Scene" ;*/
        /*$u->setSceneName($sceneName);*/

        $manager->persist($u);


        $u2 = new User();
        $email = "admin" . "@gmail.com";
        $u2->setEmail($email);
        $u2->setFirstName("admin");
        $u2->setLastName("admin");
        $u2->setPassword(self::getHasher()->hashPassword($u2, '123456'));
        $u2->setRoles(array('ROLE_ADMIN', 'ROLE_USER'));


        $manager->persist($u2);

        $manager->flush();
    }
}
