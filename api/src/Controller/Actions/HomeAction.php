<?php

declare(strict_types=1);

namespace App\Controller\Actions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class HomeAction extends AbstractController
{
    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->json([
           'message' => 'Server is running',
        ]);
    }
}