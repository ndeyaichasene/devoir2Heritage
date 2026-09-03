<?php

namespace App\Service;

interface CalculNoteInterface{
    public function calculerNote( 
        float $noteBrute,
        \DateTime $dateDepot,
        \DateTime $dateLimite
    ):float;
}