<?php

declare(strict_types=1);

namespace App\Controller\User\Post\Models;

use DateTimeImmutable;

final class PostModel
{
    /**
     * @param string             $id
     * @param string             $title
     * @param string             $slug
     * @param string|null        $image
     * @param string             $content
     * @param string|null        $author
     * @param \DateTimeImmutable $createdAt
     * @param \DateTimeImmutable $updatedAt
     */
    public function __construct(
        public string $id,
        public string $title,
        public string $slug,
        public ?string $image,
        public string $content,
        public ?string $author,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt
    )
    {
    }
}