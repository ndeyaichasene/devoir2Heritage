<?php

namespace App\Controller;

use App\Repository\CopieExamenRepositoryInterface;
use App\Service\SoumissionCopieService;

class CopieExamenController
{
    public function __construct(
        private SoumissionCopieService $service,
        private CopieExamenRepositoryInterface $repository
    ) {}

    public function create(array $errors = [], array $old = []): void
    {
        $this->render('copies/create', [
            'errors' => $errors,
            'old' => $old
        ]);
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = dirname(__DIR__, 2) . '/template/' . $view . '.php';

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new \RuntimeException("La vue [{$view}] est introuvable.");
        }
    }
}
