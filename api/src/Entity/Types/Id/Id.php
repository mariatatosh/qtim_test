<?php

declare(strict_types=1);

namespace App\Entity\Types\Id;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

final class Id
{
    /** @var string */
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::uuid($value);

        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
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