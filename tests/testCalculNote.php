<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Service\CalculNoteAvecRetardService;

$strategie = new CalculNoteAvecRetardService();

// Cas 1 : copie rendue à temps
$estEnRetard = $strategie->estEnRetard(
    new DateTime('2026-09-02 10:00:00'),
    new DateTime('2026-09-02 12:00:00')
);
$note = $strategie->calculerNote(15, $estEnRetard);
echo "À temps : $note\n";

// Cas 2 : copie rendue en retard
$estEnRetard = $strategie->estEnRetard(
    new DateTime('2026-09-02 14:00:00'),
    new DateTime('2026-09-02 12:00:00')
);
$note = $strategie->calculerNote(15, $estEnRetard);
echo "En retard : $note\n";

// Cas 3 : note minimale (ne descend pas en dessous de 0)
$estEnRetard = $strategie->estEnRetard(
    new DateTime('2026-09-02 14:00:00'),
    new DateTime('2026-09-02 12:00:00')
);
$note = $strategie->calculerNote(1, $estEnRetard);
echo "Note minimale : $note\n";
