<?php

namespace App\Entity\User;

use App\Entity\Post\Post;
use App\Entity\Types\Email\Email;
use App\Entity\Types\Id\Id;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'users')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'identifier', unique: true)]
    private Id $id;

    #[ORM\Column(type: 'email', length: 180, unique: true)]
    private Email $email;

    #[ORM\Column]
    private array $roles;

    #[ORM\Column]
    private ?string $password;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class)]
    private Collection $posts;

    /**
     * @param \App\Entity\Types\Id\Id $id
     * @param Email                   $email
     */
    public function __construct(Id $id, Email $email)
    {
        $this->id    = $id;
        $this->email = $email;
        $this->roles = ['ROLE_USER'];
        $this->posts = new ArrayCollection();
    }

    /**
     * @return \App\Entity\Types\Id\Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return \App\Entity\Types\Email\Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email->getValue();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
