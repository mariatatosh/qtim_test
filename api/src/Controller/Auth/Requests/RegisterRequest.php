<?php

declare(strict_types=1);

namespace App\Controller\Auth\Requests;

use Symfony\Component\Validator\Constraints as Assert;

final class RegisterRequest
{
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email;

    #[Assert\NotBlank]
    private ?string $password;

    /**
     * @param string|null $email
     * @param string|null $password
     */
    public function __construct(?string $email = null, ?string $password = null)
    {
        $this->email    = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}