<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\User;
use App\Service\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private UserManager $userManager)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Admin user
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

        $customer = new Customer();
        $customer->setCompanyName('Regate');

        $billingAddress = new Address();
        $billingAddress->setStreet('Rue de la Faiencerie');
        $billingAddress->setNumber('7');
        $billingAddress->setPostalCode('33300');
        $billingAddress->setCity('Bordeaux');

        $customer->setBillingAddress($billingAddress);

        $contact = new Contact();
        $contact->setFirstName('John');
        $contact->setLastName('Doe');
        $contact->setEmail('j.doe@email.fr');
        $contact->setPhone('0123456789');
        $contact->setPosition('CEO');

        $customer->setReferenceContact($contact);

        $this->userManager->createUser($customer);

        $manager->persist($customer);


        $manager->flush();
    }
}
