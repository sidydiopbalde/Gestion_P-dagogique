<?php
namespace App\Entity;

use Core\Entity\Entity ;

class AbsenceEtudiantEntity extends Entity{
     
    private int $id;
    private string $date;
    private string $module;
    private int $id_session;
    private string $motif;
    private int $id_etudiant;
    private string $etat;
    private string $piece;
  
    public function __construct() {
     
    }
    public function getId() {
        return $this->id;
    }
    public function getIdEtudiant() {
        return $this->id_etudiant;
    }
    public function getPiece() {
        return $this->piece;
    }
    public function getDate() {
        return $this->date;
    }public function getEtat() {
        return $this->etat;
    }

    public function getHeureDebut() {
        return $this->heureDebut;
    }
    public function getModule() {
        return $this->module;
    }
    public function getMotif() {
        return $this->motif;
    }
    public function getSessionId() {
        return $this->id_session;
    }
 
    public function getMode() {
        return $this->mode;
    }
   
    public function getStatut() {
        return $this->statut;
    }
    public function setStatut($statut) {
        $this->statut = $statut;
        return $this;
    }
}