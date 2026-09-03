<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\config\Bootstrap;
use App\DTO\SoumettreCopieDTO;
use App\Repository\Database;
use App\Repository\PdoCopieExamenRepository;
use App\Service\CalculNoteAvecRetardService;
use App\Service\SoumissionCopieService;

new Bootstrap();

$pdo = Database::getInstance()->getConnexion();
$repository = new PdoCopieExamenRepository($pdo);
$strategie = new CalculNoteAvecRetardService();
$service = new SoumissionCopieService($strategie, $repository);

$dto = SoumettreCopieDTO::fromArray([
    'note_brute' => 16.0,
    'date_depot' => '2026-09-03 14:00:00',
    'date_limite' => '2026-09-03 12:00:00'
]);

$copie = $service->soumettre($dto);

echo "Copie soumise avec succès !\n";
echo "Note brute : " . $copie->getNoteBrute() . "\n";
echo "Note finale : " . $copie->getNoteFinale() . "\n";
echo "Pénalité appliquée : " . ($copie->isPenaliteAppliquee() ? 'Oui' : 'Non') . "\n";
