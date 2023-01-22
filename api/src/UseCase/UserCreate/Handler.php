<?php

declare(strict_types=1);

namespace App\UseCase\UserCreate;

use App\Entity\Types\Email\Email;
use App\Entity\Types\Id\Id;
use App\Entity\User\User;
use App\Exception\User\EmailAlreadyInUse;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler]
final class Handler
{
    /**
     * @param \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $hasher
     * @param \App\Repository\UserRepository                                       $users
     */
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly UserRepository              $users
    )
    {
    }

    /**
     * @param \App\UseCase\UserCreate\Command $command
     *
     * @return void
     * @throws \App\Exception\User\EmailAlreadyInUse
     */
    public function __invoke(Command $command): void
    {
        $email = new Email($command->getEmail());

        if ($this->users->hasByEmail($email)) {
            throw new EmailAlreadyInUse($email);
        }

        $user = new User(Id::generate(), $email);

        $password = $this->hasher->hashPassword($user, $command->getPassword());

        $user->setPassword($password);

        $this->users->save($user);
    }
}