<?php

declare(strict_types=1);

namespace App\Controller\Auth\Actions;

use App\Controller\Auth\Requests\RegisterRequest;
use App\Exception\User\EmailAlreadyInUse;
use App\UseCase\UserCreate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class RegisterAction extends AbstractController
{
    /**
     * @param \Symfony\Component\Messenger\MessageBusInterface $commandBus
     */
    public function __construct(
        private readonly MessageBusInterface $commandBus
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
        try {
            $this->commandBus->dispatch(
                new UserCreate\Command(
                    $request->getEmail(),
                    $request->getPassword()
                )
            );
        } catch (EmailAlreadyInUse $e) {
            return new JsonResponse(
                [
                    'errors' => [
                        'property' => 'email',
                        'message'  => $e->getMessage(),
                    ]
                ],
                Response::HTTP_CONFLICT
            );
        }

        return new JsonResponse();
    }
}