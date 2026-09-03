<?php

namespace App\Service;

class DateUtils
{
    public static function convertirDate(string|null $date, string $nomChamp): \DateTime
    {
        if ($date === null || $date === '') {
            throw new \InvalidArgumentException(sprintf("Le champ '%s' est obligatoire.", $nomChamp));
        }

        if (is_string($date)) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                throw new \InvalidArgumentException(sprintf("Le champ '%s' doit être une date valide.", $nomChamp));
            }
        }

        return $date;
    }
}