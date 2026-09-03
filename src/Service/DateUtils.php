<?php

namespace App\Service;

class DateUtils
{
    public static function convertirDate(\DateTimeInterface|string|null $date, string $nomChamp): \DateTime
    {
        if ($date === null || $date === '') {
            throw new \InvalidArgumentException(sprintf("Le champ '%s' est obligatoire.", $nomChamp));
        }

        if ($date instanceof \DateTime) {
            return $date;
        }

        if ($date instanceof \DateTimeInterface) {
            return new \DateTime($date->format('Y-m-d H:i:s'));
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
