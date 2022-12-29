<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setUuid('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $plainPassword = 'qwerty';
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            $plainPassword
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);


        $manager->flush();
    }
}
