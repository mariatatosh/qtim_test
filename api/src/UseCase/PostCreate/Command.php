<?php

declare(strict_types=1);

namespace App\UseCase\PostCreate;

final class Command
{
    /**
     * @param string      $title
     * @param string      $content
     * @param string|null $image
     * @param string|null $authorId
     */
    public function __construct(
        private readonly string  $title,
        private readonly string  $content,
        private readonly ?string $image = null,
        private readonly ?string $authorId = null
    )
    {
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    /**
     * @return bool
     */
    public function hasAuthorId(): bool
    {
        return $this->authorId !== null;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }
}