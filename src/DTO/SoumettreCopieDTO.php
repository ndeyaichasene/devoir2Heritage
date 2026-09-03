<?php

namespace App\DTO;

use App\Service\DateUtils;
use App\Service\NoteValidator;

readonly class SoumettreCopieDTO{
    public float $noteBrute;
    public ?\DateTime $dateDepot;
    public ?\DateTime $dateLimite;

    public function __construct(
        float|string|null $noteBrute,
        string|\DateTime|null $dateDepot,
        string|\DateTime|null $dateLimite
    )
    {
        $this->noteBrute = NoteValidator::validate($noteBrute);
        $this->dateDepot = DateUtils::convertirDate($dateDepot, 'date de depot');
        $this->dateLimite = DateUtils::convertirDate($dateLimite, 'date limite');
    }  

    public static function fromArray(array $data): SoumettreCopieDTO
    {
        $noteBrute = $data['note_brute'] ?? null;
        $dateDepot = $data['date_depot'] ?? null;
        $dateLimite = $data['date_limite'] ?? null;

        return new SoumettreCopieDTO($noteBrute, $dateDepot, $dateLimite);
    }
}
