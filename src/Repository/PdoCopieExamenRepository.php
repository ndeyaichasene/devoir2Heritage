<?php

namespace App\Repository;

use App\Entity\CopieExamen;


class PdoCopieExamenRepository extends Query implements CopieExamenRepositoryInterface{
    
    public function __construct(\PDO $pdo)
    {
         parent::__construct($pdo);
    }
    public function save(CopieExamen $copieExamen):void{
        $sql = "INSERT INTO copies (dateDepot, noteBrute,noteFinale, penaliteAppliquee, dateLimite)
                VALUES (:dateDepot,:noteBrute,:noteFinale,:penaliteAppliquee,:dateLimite)
        ";
        $params = [
            'dateDepot'=>$copieExamen->getDateDepot()->format('Y-m-d H:i:s'),
            'noteBrute'=>$copieExamen->getNoteBrute(),
            'noteFinale'=>$copieExamen->getNoteFinale(),
            'penaliteAppliquee'=>$copieExamen->isPenaliteAppliquee(),
            'dateLimite'=>$copieExamen->getDateLimite()->format('Y-m-d H:i:s'),
            ];

        $this->executeUpdate($sql,$params);
    }
    public function findAll():array{
    return [];
    }
    public function findById(int $id):?CopieExamen{
        return null;

    }

}