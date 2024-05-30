<?php

namespace App\Shared\Infrastructure\ArgumentResolver;

use App\Shared\Application\Exception\ValidationException;
use App\Shared\Application\Validator\Validator;
use App\Shared\Infrastructure\Attribute\RequestBody;
use App\Shared\Infrastructure\Attribute\Valid;
use App\Shared\Infrastructure\Exception\RequestBodyConvertException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class RequestBodyArgumentResolver implements ArgumentValueResolverInterface
{
    public function __construct(private readonly SerializerInterface $serializer, private readonly Validator $validator)
    {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return !empty($argument->getAttributes(RequestBody::class, ArgumentMetadata::IS_INSTANCEOF));
    }

    /**
     * @throws \Exception
     */
    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        try {
            $model = $this->serializer->deserialize(
                $request->getContent(),
                $argument->getType(),
                JsonEncoder::FORMAT
            );
        } catch (\Throwable $throwable) {
            throw new RequestBodyConvertException($throwable);
        }

        if (!empty($argument->getAttributes(Valid::class, ArgumentMetadata::IS_INSTANCEOF))) {

            $errors = $this->validator->validate($model);

            if (!empty($errors)) {
                throw new ValidationException($errors);
            }
        }

        yield $model;
    }
}