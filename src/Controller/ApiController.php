<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Result;
use App\Service\QuestionFetcher;
use App\Service\ResultService;
use App\Test\AnswersSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
final class ApiController extends AbstractController
{
    #[Route('/')]
    public function first(QuestionFetcher $questionFetcher)
    {
        $data = [];
        $data['question'] = $questionFetcher->getFirst();

        return $this->json($data, Response::HTTP_OK);
    }

    #[Route('/next/{id}')]
    public function next(int $id, QuestionFetcher $questionFetcher): Response
    {
        $data = [];
        $data['question'] = $questionFetcher->findOneNext($id);

        return $this->json($data, Response::HTTP_OK);
    }

    #[Route('/save')]
    public function save(Request $request, ResultService $resultService): Response
    {
        // validation here
        $answers = AnswersSerializer::deserialize($request->getContent());

        $result = new Result();
        $result->setAnswers($request->getContent());
        $resultService->create($result);

        return $this->json(['id' => $result->getId()], Response::HTTP_OK);
    }
}
