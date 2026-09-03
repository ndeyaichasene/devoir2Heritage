<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Service\CalculNoteAvecRetardService;

$strategie = new CalculNoteAvecRetardService();

// Cas 1 : copie rendue à temps
$note = $strategie->calculerNote(
    15,
    new DateTime('2026-09-02 10:00:00'),
    new DateTime('2026-09-02 12:00:00')
);

echo "À temps : $note\n";

// Cas 2 : copie rendue en retard
$note = $strategie->calculerNote(
    15,
    new DateTime('2026-09-02 14:00:00'),
    new DateTime('2026-09-02 12:00:00')
);

echo "En retard : $note\n";


$note = $strategie->calculerNote(
    1,
    new DateTime('2026-09-02 14:00:00'),
    new DateTime('2026-09-02 12:00:00')
);

echo "Note minimale : $note\n";