<?php

namespace App\Model;

use Core\Model\Model;
use App\Entity\LoginEntity;

class loginModel extends Model
{
    protected string $table = 'Utilisateurs';

    public function getEntity()
    {
        return LoginEntity::class;
    }

    public function getAllProfesseurs()
    {
        $sql = "SELECT email, mot_de_passe FROM $this->table;";
        $statement = $this->database->query($sql, $this->getEntity(), true);
        
        if ($statement) {
            return $statement;
        }
    }
    
    public function checkCredentials($email, $password)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email LIMIT 1;";
        $statement = $this->database->prepare($sql, ['email' => $email], $this->getEntity(), true);
        // var_dump($statement);die;
        if ($statement) {
            $user = $statement;
            // Assuming passwords are stored hashed, use password_verify to check
            if (password_verify($password, $user->getMotDePasse())) {
                return $user;
            }
        }
        return false;
    }
    public function registerUser($prenom, $nom, $email, $telephone, $password, $id_role)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO $this->table (prenom, nom, email, telephone, mot_de_passe, id_role) VALUES (:prenom, :nom, :email, :telephone, :mot_de_passe, :id_role)";
        $statement = $this->database->prepare($sql, [
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'mot_de_passe' => $hashedPassword,
            'id_role' => $id_role
        ],$this->getEntity());
        return $statement->execute();
    }
    public function getEtudiantId($id) {
        $sql = "SELECT e.id 
                FROM `Etudiants` e
                JOIN `Utilisateurs` u ON e.id_user = u.id
                WHERE u.id = :id";
        
        $statement = $this->database->prepare($sql,['id' => $id],$this->getEntity());
      
       // fetch() for single result or fetchAll() for multiple results
        
        return $statement; // Return the id or null if no result
    }
    
}
