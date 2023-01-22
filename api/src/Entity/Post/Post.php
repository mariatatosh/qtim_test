<?php

declare(strict_types=1);

namespace App\Entity\Post;

use App\Entity\Types\Id\Id;
use App\Entity\User\User;
use App\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'posts')]
#[ORM\Entity(repositoryClass: PostRepository::class)]
final class Post
{
    #[ORM\Id]
    #[ORM\Column(type: 'identifier', unique: true)]
    private Id $id;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'string')]
    private string $slug;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $image;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    private ?User $author;

    #[ORM\Column(type: 'string', enumType: Status::class)]
    private Status $status;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $archivedAt;

    /**
     * @param \App\Entity\Types\Id\Id    $id
     * @param string                     $title
     * @param string                     $slug
     * @param string                     $content
     * @param string|null                $image
     * @param \App\Entity\User\User|null $author
     */
    public function __construct(
        Id     $id,
        string $title,
        string $slug,
        string $content,
        ?string $image,
        ?User  $author
    )
    {
        $this->id         = $id;
        $this->title      = $title;
        $this->slug       = $slug;
        $this->content    = $content;
        $this->image      = $image;
        $this->author     = $author;
        $this->status     = Status::PUBLISHED;
        $this->createdAt  = new DateTimeImmutable();
        $this->updatedAt  = new DateTimeImmutable();
        $this->archivedAt = null;
    }

    /**
     * @return \App\Entity\Types\Id\Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
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

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }
}