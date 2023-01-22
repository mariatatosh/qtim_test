<?php

declare(strict_types=1);

namespace App\Controller\User\Post\Actions;

use App\Controller\User\Post\Models\PostModel;
use App\Entity\Post\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ListAction extends AbstractController
{
    /**
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    #[Route('/posts', name: 'user_posts_list', methods: 'GET')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            array_map(
                static fn(Post $post): PostModel => new PostModel(
                    $post->getId()->getValue(),
                    $post->getTitle(),
                    $post->getSlug(),
                    $post->getImage(),
                    $post->getContent(),
                    $post->getAuthor()?->getEmail(),
                    $post->getCreatedAt(),
                    $post->getUpdatedAt()
                ),
                $this->getPosts()
            )
        );
    }

    /**
     * @return \App\Entity\Post\Post[]
     */
    private function getPosts(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('p')
            ->from(Post::class, 'p')
            ->orderBy('p.createdAt')
            ->getQuery()
            ->getResult();
    }
}