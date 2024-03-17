<?php

namespace App\ArgumentResolver;

use App\Exception\RequestBodyConvertException;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function PHPUnit\Framework\countOf;

class RequestBodyArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface  $validator
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        try {
            $model = $this->serializer->deserialize(
                $request->getContent(),
                $argument->getType(),
                JsonEncoder::FORMAT
            );
        } catch (\Throwable $throwable) {
            throw new RequestBodyConvertException(previous: $throwable);
        }

        $errors = $this->validator->validate($model);
        if (count($errors)) {
            throw new ValidationException($errors);
        }

        yield $model;
    }
}
