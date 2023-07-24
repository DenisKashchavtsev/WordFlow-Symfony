<?php

namespace App\Shared\Infrastructure\ArgumentResolver;

use App\Shared\Infrastructure\Attribute\RequestBody;
use Generator;
use PHPUnit\Util\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class RequestBodyArgumentResolver implements ArgumentValueResolverInterface
{
    public function __construct(private SerializerInterface $serializer, private ValidatorInterface $validator)
    {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return count($argument->getAttributes(RequestBody::class, ArgumentMetadata::IS_INSTANCEOF)) > 0;
    }

    /**
     * @throws \Exception
     */
    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        try {
            $model = $this->serializer->deserialize(
                $request->getContent(),
                $argument->getType(),
                JsonEncoder::FORMAT
            );
        } catch (Throwable $throwable) {
            throw new \Exception($throwable);
        }

        $errors = $this->validator->validate($model);
        if (count($errors) > 0) {
            throw new Exception($errors);
        }

        yield $model;
    }
}
