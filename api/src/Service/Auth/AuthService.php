<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\User\User;
use LogicException;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

final class AuthService
{
    /**
     * @param \Symfony\Bundle\SecurityBundle\Security $security
     */
    public function __construct(private readonly Security $security)
    {
    }

    /**
     * @return \App\Entity\User\User
     * @throws \LogicException
     */
    public function getCurrentUser(): User
    {
        if ($user = $this->security->getUser()) {
            /** @var \App\Entity\User\User $user */
            return $user;
        }

        throw new LogicException('User is not authenticated');
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return $this->security->getUser() instanceof UserInterface;
    }
}