<?php

declare(strict_types=1);

namespace App\Test;

final readonly class Calculator
{
    public function __construct(
        private AnswersHolder $answersHolder,
        private QuestionsHolder $questionsHolder
    ) {
    }

    public function calculate(): CalculationData
    {
        $data = [
            'correct' => [],
            'incorrect' => [],
        ];

        $answers = $this->answersHolder->getAll();
        $questions = $this->questionsHolder->byId();

        foreach ($answers as $answer) {
            $question = $questions[$answer->getQuestionId()];
            if ($answer->isCorrect($question)) {
                $data['correct'][] = $question;
            } else {
                $data['incorrect'][] = $question;
            }
        }

        return new CalculationData($data);
    }
}
