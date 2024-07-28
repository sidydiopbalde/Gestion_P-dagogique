<?php
namespace App\Entity;

use Core\Entity\Entity ;

class ListeCoursEntity extends Entity{
     
    private int $id;
    private string $libelle;
    private string $mot_de_passe;
    private string $nombreHeure;
    private string $semestre;
    private string $module;
    private string $telephone;
    private string $nom;
    private string $classe;
    private int $total;
    private string $prenom;
    private int $id_role;
    private string $specialite;
    private string $grade;
    // p.grade,p.specialite,u.nom,u.prenom
    public function __construct() {
     
    }
    public function getId() {
        return $this->id;
    }
    public function getTotal() {
        return $this->total;
    }
    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->mot_de_passe;
    }
    public function getNombreHeure() {
        return $this->nombreHeure;
    }
    public function getSemestre() {
        return $this->semestre;
    }
    public function getModule() {
        return $this->module;
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
    public function getClasse() {
        return $this->classe;
    }
    
}