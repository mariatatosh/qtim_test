<?php

declare(strict_types=1);

namespace App\Exception\User;

use App\Entity\Types\Email\Email;
use DomainException;

final class EmailAlreadyInUse extends DomainException
{
    /** @var \App\Entity\Types\Email\Email */
    private Email $email;

    /**
     * @param \App\Entity\Types\Email\Email $email
     */
    public function __construct(Email $email)
    {
        $this->email = $email;

        parent::__construct(sprintf('Email "%s" is already in use', $email->getValue()));
    }

    /**
     * @return \App\Entity\Types\Email\Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }
}