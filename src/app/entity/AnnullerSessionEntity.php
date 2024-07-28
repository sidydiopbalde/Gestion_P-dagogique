<?php
namespace App\Entity;

use Core\Entity\Entity ;

class AnnullerSessionEntity extends Entity{
     
    private int $id;
    private string $statut;
    private string $date;
    private string $heureDebut;
    private string $nombreHeure;
    private string $heureFin;
    private string $module;
    private string $mode;
    private string $nom;
    private string $prenom;
    private string $motif;
    private int $id_cours;
    private int $id_salle;

    public function __construct() {
     
    }
    public function getId() {
        return $this->id;
    }
    public function getDate() {
        return $this->date;
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
    public function getHeureFin() {
        return $this->heureFin;
    }
    public function getNombreHeure() {
        return $this->nombreHeure;
    }
  
    public function getMode() {
        return $this->mode;
    }
    public function getRole() {
        return $this->id_role;
    }
    public function getGrade() {
        return $this->grade;
    }
    public function getSpecialite() {
        return $this->specialite;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }
  
    
    public function getStatut() {
        return $this->statut;
    }
    public function setStatut($statut) {
        $this->statut = $statut;
        return $this;
    }
}