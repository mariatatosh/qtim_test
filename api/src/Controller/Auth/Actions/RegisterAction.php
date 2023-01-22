<?php

declare(strict_types=1);

namespace App\Controller\Auth\Actions;

use App\Controller\Auth\Requests\RegisterRequest;
use App\Entity\Types\Email\Email;
use App\Entity\Types\Id\Id;
use App\Entity\User\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

final class RegisterAction extends AbstractController
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
     * @param \App\Controller\Auth\Requests\RegisterRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    #[Route('/register', name: 'auth_register', methods: 'POST')]
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $email = new Email($request->getEmail());

        if ($this->users->hasByEmail($email)) {
            return new JsonResponse([
                'message' => 'User with such email already exists',
            ]);
        }

        $user = new User(Id::generate(), $email);

        $password = $this->hasher->hashPassword($user, $request->getPassword());

        $user->setPassword($password);

        $this->users->save($user);

        return new JsonResponse();
    }
}