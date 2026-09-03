<?php

namespace App\Service;



class CalculNoteAvecRetardService implements CalculNoteInterface{
    
    public function calculerNote(float $noteBrute, \DateTime $dateDepot, \DateTime $dateLimite): float
    {
        if ($dateDepot > $dateLimite) {
           $noteFinale = $noteBrute - 2;
        }else {
            $noteFinale = $noteBrute;
        }

        return $noteFinale;
    }

}