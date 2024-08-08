<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\QuestionFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
final class ApiController extends AbstractController
{
    #[Route('/next/{id}')]
    public function next(int $id, QuestionFetcher $questionFetcher): Response
    {
        $data = [];
        $data['question'] = $questionFetcher->findOneNext($id);

        return $this->json($data, Response::HTTP_OK);
    }
}
