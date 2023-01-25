<?php

declare(strict_types=1);

namespace App\Controller\User\Post\Models;

use DateTimeImmutable;

final class PostModel
{
    /**
     * @param string|null $id
     * @param string|null $title
     * @param string|null $slug
     * @param string|null $image
     * @param string|null $content
     * @param string|null $author
     * @param string|null $createdAt
     * @param string|null $updatedAt
     */
    public function __construct(
        public ?string $id = null,
        public ?string $title = null,
        public ?string $slug = null,
        public ?string $image = null,
        public ?string $content = null,
        public ?string $author = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null
    )
    {
    }
}