<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Post\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @param \App\Entity\Post\Post $post
     *
     * @return void
     */
    public function save(Post $post): void
    {
        $this->getEntityManager()->persist($post);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $slug
     *
     * @return bool
     */
    public function hasBySlug(string $slug): bool
    {
        return count($this->getEntityManager()->getRepository(Post::class)->findBy(['slug' => $slug])) > 0;
    }
}