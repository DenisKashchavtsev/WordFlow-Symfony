<?php

namespace App\Words\Application\Controller\Word;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Command\Word\UpdateWord\UpdateWordCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/words/{id}', methods: ['PUT'])]
class UpdateWordController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new UpdateWordCommand($request->get('id'), $data['source'], $data['translate']);
        $word = $this->commandBus->execute($command);

        return new JsonResponse($word, 200);
    }
}