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
        $this->verifierNote($noteBrute);
        $this->noteBrute =$noteBrute;
        $this->penaliteAppliquee = $penaliteAppliquee;
        $this->calculerNoteFinale();
        $this->dateLimite = $dateLimite;
    }

    public function getNoteBrute():float
    {
        return $this->noteBrute;
    }

    public function setNoteBrute(float $noteBrute):void
    {   
        $this->verifierNote($noteBrute);
        $this->noteBrute = $noteBrute;
        $this->calculerNoteFinale();
    }

    public function calculerNoteFinale():void{
        if ($this->penaliteAppliquee) {
            $this->noteFinale = max(0,$this->noteBrute - 2);
        }else{
            $this->noteFinale = $this->noteBrute;
        }

    }
      public function getNoteFinale():float
    {
        return $this->noteFinale;
    }

    public function isPenaliteAppliquee():bool
    {
        return $this->penaliteAppliquee;

    }

    public function setPenaliteAppliquee(bool $penaliteAppliquee):void
    {
        $this->penaliteAppliquee = $penaliteAppliquee;
        $this->calculerNoteFinale();

    }
    
    private function verifierNote(float $note):void{
        if ($note < 0 || $note > 20) {
           throw new \InvalidArgumentException("la note  doit etre entre 0 et 20");
           
        }
    }


    public function getDateLimite():\DateTime
    {
            return $this->dateLimite;
    }
}