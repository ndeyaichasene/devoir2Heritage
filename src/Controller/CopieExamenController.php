<?php

namespace App\Controller;

use App\DTO\SoumettreCopieDTO;
use App\Repository\CopieExamenRepositoryInterface;
use App\Service\SoumissionCopieService;

class CopieExamenController
{
    public function __construct(
        private SoumissionCopieService $service,
        private CopieExamenRepositoryInterface $repository
    ) {}

    public function index(): void
    {
        $copies = $this->repository->findAll();
        $this->render('copies/index', [
            'copies' => $copies
        ]);
    }

    public function show(int $id): void
    {
        $copie = $this->repository->findById($id);

        if ($copie === null) {
            http_response_code(404);
            $this->render('error/404', [
                'message' => "La copie d'examen #{$id} est introuvable."
            ]);
            return;
        }

        $this->render('copies/show', [
            'copie' => $copie
        ]);
    }

    public function create(array $errors = [], array $old = []): void
    {
        $this->render('copies/create', [
            'errors' => $errors,
            'old' => $old
        ]);
    }

    public function store(): void
    {
        try {
            $dto = SoumettreCopieDTO::fromArray($_POST);
            $copie = $this->service->soumettre($dto);

            $redirectUrl = $copie->getId() ? '/copies/' . $copie->getId() : '/copies';
            header("Location: {$redirectUrl}");
            exit;
        } catch (\InvalidArgumentException $e) {
            http_response_code(422);
            $this->create(
                errors: [$e->getMessage()],
                old: $_POST
            );
        } catch (\Throwable $e) {
            http_response_code(500);
            $this->render('error/error', [
                'message' => "Une erreur inattendue est survenue : " . $e->getMessage()
            ]);
        }
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
