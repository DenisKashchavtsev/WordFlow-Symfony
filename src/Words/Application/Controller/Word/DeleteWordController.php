<?php

namespace App\Words\Application\Controller\Word;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Command\Word\DeleteWord\DeleteWordCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/words/{id?}', methods: ['DELETE'])]
class DeleteWordController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new DeleteWordCommand($request->get('id') ? [$request->get('id')] : $data['ids']);
        $this->commandBus->execute($command);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}