<?php
namespace App\Entity;

use Core\Entity\Entity ;

class LoginEntity extends Entity{
     
    private int $id;
    private string $email;
    private string $mot_de_passe;
    private string $telephone;
    private string $nom;
    private string $prenom;
    private int $id_role;
    private int $etudiant_id;

    public function __construct() {
     
    }
    public function getId() {
        return $this->id;
    }  
    public function getEtudiant_id() {
        return $this->etudiant_id;
    }
    public function getIdRole() {
        return $this->id_role;
    }
    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->mot_de_passe;
    }
}