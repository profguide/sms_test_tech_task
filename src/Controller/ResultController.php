<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\QuestionFetcher;
use App\Service\ResultService;
use App\Test\Calculator;
use App\Test\QuestionsHolder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ResultController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/result/{id}')]
    public function calculation(int $id, ResultService $resultService, QuestionFetcher $questionFetcher): Response
    {
        $result = $resultService->findOneById($id);

        $questions = $questionFetcher->getAll();
        $calculator = new Calculator($result->getAnswerHolder(), new QuestionsHolder($questions));

        $calculation = $calculator->calculate();

        return $this->render('result/calculation.html.twig', [
            'correct' => $calculation->get('correct'),
            'incorrect' => $calculation->get('incorrect'),
        ]);
    }
}
