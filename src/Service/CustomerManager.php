<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;

class CustomerManager
{
    public function __construct(private LoginLinkHandlerInterface $loginLinkHandler)
    {
    }

    public function generateConsultLink(User $user): string
    {
        $loginLinkDetails = $this->loginLinkHandler->createLoginLink($user, null, 315576000);
        return $loginLinkDetails->getUrl() . '&_target_path=/login';
    }
}