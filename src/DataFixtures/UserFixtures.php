<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @codeCoverageIgnore
 */
class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     * @codeCoverageIgnore
     */
    public function load(ObjectManager $manager): void
    {
        $u = new User();
        $u->setUsername('DCD');
        $u->setPassword('$2y$13$n32AXBB2Udsm8M8Jw6GEpuZ9PYZgIkRlenonYt6mMl2URytSFxuQq');
        $u->setRoles(["ROLE_USER","ROLE_ADMIN"]);
        $u->setEmail("mathieu.helary@gmail.com");
        $manager->persist($u);
        unset($u);

        $u = new User();
        $u->setUsername('guest1');
        $u->setPassword('$2y$13$n32AXBB2Udsm8M8Jw6GEpuZ9PYZgIkRlenonYt6mMl2URytSFxuQq');
        $u->setRoles(["ROLE_USER"]);
        $u->setEmail("guest1@guest.fr");
        $manager->persist($u);
        unset($u);

        $u = new User();
        $u->setUsername('guest2');
        $u->setPassword('$2y$13$n32AXBB2Udsm8M8Jw6GEpuZ9PYZgIkRlenonYt6mMl2URytSFxuQq');
        $u->setRoles(["ROLE_USER"]);
        $u->setEmail("guest2@guest.fr");
        $manager->persist($u);
        unset($u);

        $manager->flush();
    }
}
