<?php
namespace App\App\Model;

use App\App\Entity\UtilisateurEntity;
use App\App\Entity\DetteClientPaiementEntity;

use App\Core\Model\Model;
use stdClass;

class UtilisateurModel extends Model{   
    protected string $table = 'utilisateurs';
  

    public function getEntity(){
        return UtilisateurEntity::class;
    }
 
    public function save($data) {
        $sql = "INSERT INTO $this->table (nom, prenom, email, telephone,motDePasse, photo) VALUES (:nom, :prenom, :email, :tel,:motDePasse, :photo)";
        $this->database->prepare($sql, $data,$this->getEntity());
    }
 
    public function findByPhone($phone) {
        $statement = $this->query("SELECT * FROM utilisateurs   WHERE telephone = :telephone ",$this->getEntity(),['telephone' => $phone],true);
        // $statement->execute(['telephone' => $phone]);
        // var_dump($statement);
        // die();
        return $statement;
    }
    public function findByMail($email) {
        $statement = $this->query("SELECT * FROM utilisateurs   WHERE email = :email ",$this->getEntity(),['email' => $email],true);
        // $statement->execute(['telephone' => $phone]);
        // var_dump($statement);
        // die();
        return $statement;
    }

    public function search(string $telephone)
    {
        $sql = "SELECT 
        u.id,
        u.nom,
        u.prenom,
        u.email,
        u.telephone,
        u.photo,
        SUM(d.montant) AS totalDette,
        SUM(p.montant_verse) AS montantVerse
        
    FROM 
        utilisateurs u
    LEFT JOIN 
        Dette d ON d.id_client = u.id
    LEFT JOIN 
        Paiments p ON p.id_dette = d.id
    WHERE 
        u.telephone = :telephone
    GROUP BY 
        u.id, u.nom, u.prenom, u.email, u.telephone, u.photo;";

        $data = ["telephone" => $telephone];
        // if ($dette) $data["dette"] = $dette;

        return $this->query($sql,\stdClass::class,   $data, true);
    }
}