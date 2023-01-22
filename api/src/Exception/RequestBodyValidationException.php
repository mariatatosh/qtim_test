<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

final class RequestBodyValidationException extends Exception
{
    /** @var array */
    private array $errors;

    /**
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;

        parent::__construct('Request body validation failed');
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}