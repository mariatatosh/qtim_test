<?php

declare(strict_types=1);

namespace App\Controller\User\Post\Requests;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateRequest
{
    #[Assert\NotBlank]
    private ?string $title;

    #[Assert\Uuid]
    private ?string $authorId;

    #[Assert\NotBlank]
    private ?string $content;

    #[Assert\Url]
    private ?string $image;

    /**
     * @param string|null $title
     * @param string|null $authorId
     * @param string|null $content
     * @param string|null $image
     */
    public function __construct(
        ?string $title = null,
        ?string $authorId = null,
        ?string $content = null,
        ?string $image = null
    )
    {
        $this->title    = $title;
        $this->authorId = $authorId;
        $this->content  = $content;
        $this->image    = $image;
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