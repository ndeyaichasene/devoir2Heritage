<?php

namespace App\Service;

use App\DTO\SoumettreCopieDTO;
use App\Entity\CopieExamen;
use App\Repository\PdoCopieExamenRepository;

final class SoumissionCopieService
{
    public function __construct(
        private readonly PdoCopieExamenRepository $repository
    ) {}

    public function soumettre(CalculNoteInterface $strategie,SoumettreCopieDTO $dto)
    {
        $noteBrute = $dto->noteBrute;
        $dateDepot = $dto->dateDepot;
        $dateLimite = $dto->dateLimite;

        $estEnRetard = $strategie->estEnRetard($dateDepot, $dateLimite);

        $noteFinale = $strategie->calculerNote(
            $noteBrute,
            $estEnRetard
        );

        $penaliteAppliquee = $estEnRetard;

        $copieExamen = new CopieExamen(
            noteBrute: $noteBrute,
            penaliteAppliquee: $penaliteAppliquee,
            dateLimite: $dateLimite,
            dateDepot: $dateDepot
        );

        $copieExamen->setNoteFinale($noteFinale);

        $this->repository->save($copieExamen);

        return $copieExamen;
    }
}
