<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("mathieu.helary@gmail.com");
        $user->setPassword("123456");
        $user->setRoles(["ROLE_USER","ROLE_ADMIN"]);
        $manager->persist($user);

        $manager->flush();
    }
}
