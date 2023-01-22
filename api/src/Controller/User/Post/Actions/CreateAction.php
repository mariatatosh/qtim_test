<?php

declare(strict_types=1);

namespace App\Controller\User\Post\Actions;

use App\Controller\User\Post\Requests\CreateRequest;
use App\UseCase\PostCreate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class CreateAction extends AbstractController
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
     * @param \App\Controller\User\Post\Requests\CreateRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    #[Route('/posts', name: 'user_posts_create', methods: 'POST')]
    public function __invoke(CreateRequest $request): JsonResponse
    {
        $this->commandBus->dispatch(
            new PostCreate\Command(
                $request->getTitle(),
                $request->getContent(),
                $request->getImage(),
                $request->getAuthorId()
            )
        );

        return new JsonResponse();
    }
}