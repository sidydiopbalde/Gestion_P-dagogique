<?php
namespace App\Entity;

use Core\Entity\Entity ;

class SessionEntity extends Entity{
     
    private int $id;
    private string $date;
    private string $heureDebut;
    private string $nombreHeure;
    private string $heureFin;
    private string $statut;
    private string $mode;
    private string $nom;
    private string $prenom;
    private string $module;
    private string $etat;
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
    public function getEtat() {
        return $this->etat;
    }
    public function getModule() {
        return $this->module;
    }
    public function getHeureDebut() {
        return $this->heureDebut;
    }

    public function getHeureFin() {
        return $this->heureFin;
    }
    public function getNombreHeure() {
        return $this->nombreHeure;
    }
    public function getStatut() {
        return $this->statut;
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
}