<?php

namespace App\Service;

use App\DTO\SoumettreCopieDTO;
use App\Entity\CopieExamen;
use App\Repository\PdoCopieExamenRepository;

class SoumissionCopieService
{
    public function __construct(
        private CalculNoteInterface $strategie,
        private PdoCopieExamenRepository $repository
    ) {}

    public function soumettre(SoumettreCopieDTO $dto)
    {
        $noteBrute = $dto->noteBrute;
        $dateDepot = $dto->dateDepot;
        $dateLimite = $dto->dateLimite;

        $estEnRetard = $this->strategie->estEnRetard($dateDepot, $dateLimite);

        $noteFinale = $this->strategie->calculerNote(
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
