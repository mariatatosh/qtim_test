<?php

declare(strict_types=1);

namespace App\ValueResolver;

use App\Exception\RequestBodyValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RequestBodyResolver implements ValueResolverInterface
{
    /**
     * @param \Symfony\Component\Serializer\SerializerInterface         $serializer
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     */
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface  $validator
    )
    {
    }

    /**
     * @throws \App\Exception\RequestBodyValidationException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if ($request->getContentTypeFormat() !== 'json') {
            return [];
        }

        $body = $this->serializer->deserialize(
            $request->getContent(),
            $argument->getType(),
            $request->getContentTypeFormat()
        );

        $errors = $this->validator->validate($body);

        if ($errors->count() > 0) {
            throw new RequestBodyValidationException(
                array_map(
                    static fn(ConstraintViolation $violation): array => [
                        'property' => $violation->getPropertyPath(),
                        'message'  => $violation->getMessage(),
                    ],
                    iterator_to_array($errors)
                )
            );
        }

        return [$body];
    }
}