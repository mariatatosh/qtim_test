<?php

declare(strict_types=1);

namespace App\Entity\Post;

enum Status: string
{
    case PUBLISHED = 'PUBLISHED';
    case ARCHIVED = 'ARCHIVED';
}
