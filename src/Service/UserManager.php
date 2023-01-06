<?php

namespace App\Service;

use App\Entity\Customer;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class UserManager
{
    public function __construct(private UserRepository $userRepository, private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function createUser(Customer $customer, bool $flush = false): void
    {
        $user = new User();
        $user->setUuid(Uuid::v4());
        $user->setCustomer($customer);
        $user->setRoles(['ROLE_CUSTOMER']);
        $plainPassword = random_bytes(10);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plainPassword
        );
        $user->setPassword($hashedPassword);

        $this->userRepository->save($user, $flush);
    }
}