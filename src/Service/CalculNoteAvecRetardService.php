<?php

namespace App\Service;

class CalculNoteAvecRetardService implements CalculNoteInterface{
    
    public function estEnRetard(\DateTime $dateDepot, \DateTime $dateLimite): bool
    {
        return $dateDepot > $dateLimite;
    }

    public function calculerNote(float $noteBrute, bool $estEnRetard): float
    {
        if (! $estEnRetard) {
            return $noteFinale = $noteBrute;
        }
        return $noteFinale = max(0, $noteBrute - 2);
    }    

}
