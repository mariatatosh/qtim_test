<?php

declare(strict_types=1);

namespace App\UseCase\PostCreate;

use App\Entity\Post\Post;
use App\Entity\Types\Id\Id;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class Handler
{
    /**
     * @param \App\Repository\PostRepository $posts
     * @param \App\Repository\UserRepository $users
     */
    public function __construct(
        private readonly PostRepository $posts,
        private readonly UserRepository $users
    )
    {
    }

    /**
     * @param \App\UseCase\PostCreate\Command $command
     *
     * @return void
     */
    public function __invoke(Command $command): void
    {
        $post = new Post(
            Id::generate(),
            $command->getTitle(),
            Id::generate()->getValue(),
            $command->getContent(),
            $command->getImage(),
            $command->hasAuthorId()
                ? $this->users->get(new Id($command->getAuthorId()))
                : null,
        );

        $this->posts->save($post);
    }
}