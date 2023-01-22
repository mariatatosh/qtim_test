<?php

declare(strict_types=1);

namespace App\Controller\User\Post\Actions;

use App\Controller\User\Post\Requests\CreateRequest;
use App\Entity\Post\Post;
use App\Entity\Types\Id\Id;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CreateAction extends AbstractController
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
     * @param \App\Controller\User\Post\Requests\CreateRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    #[Route('/posts', name: 'user_posts_create', methods: 'POST')]
    public function __invoke(CreateRequest $request): JsonResponse
    {
        if ($this->posts->hasBySlug($slug = Uuid::uuid4()->toString())) {
            return new JsonResponse([
                'error' => 'Post with such slug already exists'
            ]);
        }

        $post = new Post(
            Id::generate(),
            $request->getTitle(),
            $slug,
            $request->getContent(),
            $request->getImage(),
            $request->hasAuthorId()
                ? $this->users->get(new Id($request->getAuthorId()))
                : null,
        );

        $this->posts->save($post);

        return new JsonResponse();
    }
}