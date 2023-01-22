<?php

declare(strict_types=1);

namespace App\Entity\Types\Email;

use Webmozart\Assert\Assert;

final class Email
{
    /** @var string */
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::email($value);

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}