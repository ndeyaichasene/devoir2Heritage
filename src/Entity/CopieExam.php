<?php

namespace App\Entity;

use App\Entity\AbstractDocument;
use DateTime;

class CopieExamen extends AbstractDocument{
    
    private float $noteBrute;
    private float $noteFinale;
    private bool $penaliteAppliquee;
    private DateTime $dateLimite;

     public function __construct(float $noteBrute,bool $penaliteAppliquee, DateTime $dateLimite, \DateTime $dateDepot,?int $id=null)
    {
        parent::__construct( $dateDepot ,$id);
        $this->noteBrute =$noteBrute;
        $this->penaliteAppliquee = $penaliteAppliquee;
        $this->dateLimite = $dateLimite;
    }

    public function getNoteBrute():float
    {
        return $this->noteBrute;
    }

    public function setNoteBrute(float $noteBrute):void
    {   
      
        $this->noteBrute = $noteBrute;
    }

      public function getNoteFinale():float
    {
        return $this->noteFinale;
    }
    public function setNoteFinale(float $noteFinale):void
    {   
      
        $this->noteFinale = $noteFinale;
    }

    public function isPenaliteAppliquee():bool
    {
        return $this->penaliteAppliquee;

    }

    public function setPenaliteAppliquee(bool $penaliteAppliquee):void
    {
        $this->penaliteAppliquee = $penaliteAppliquee;

    }
    

    public function getDateLimite():\DateTime
    {
            return $this->dateLimite;
    }

public static function toEntity(\stdClass $obj): self
{
    $id = $obj->id ?? null;
    $dateDepot = $obj->datedepot ?? new \DateTime();
    $noteBrute = $obj->notebrute ?? 0.0;
    $noteFinale = $obj->notefinale ?? 0.0;
    $penaliteAppliquee = $obj->penaliteappliquee ?? false;
    $dateLimite = $obj->datelimite ?? new \DateTime();

    $copieExamen = new self(
        noteBrute: (float) $noteBrute,
        penaliteAppliquee: (bool) $penaliteAppliquee,
        dateLimite: new \DateTime($dateLimite),
        dateDepot: new \DateTime($dateDepot),
        id: $id !== null ? (int) $id : null
    );

    $copieExamen->setNoteFinale((float) $noteFinale);

    return $copieExamen;
}
}