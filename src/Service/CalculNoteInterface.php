<?php

namespace App\Service;

interface CalculNoteInterface{
    public function estEnRetard(\DateTime $dateDepot, \DateTime $dateLimite): bool;
    public function calculerNote(float $noteBrute, bool $estEnRetard): float;
}
