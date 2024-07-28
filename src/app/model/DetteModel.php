<?php
namespace App\Model;
use Core\Model\Model;
use App\Entity\DetteEntity;

class DetteModel extends Model
{
    protected string $table = 'Dette';

    public function getEntity()
    {
        // return DetteEntity::class;
    }

    public function getDettesByUtilisateurPhone($telephone)
    {
       
        $sql = "SELECT 
        u.id,
        u.nom,
        u.prenom,
        u.email,
        d.date as date_dette,
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
        d.date,u.id, u.nom, u.prenom, u.email, u.telephone, u.photo;";
        $data = ["telephone" => $telephone];

        // return $this->query($sql,$this->getEntity()::class,   $data);
    
    }

    public function getDettesByUtilisateurPhone2($telephone)
    {
    
        $sql = "SELECT 
        d.id,
        u.nom,
        u.prenom,
        u.email,
        u.telephone,
        d.date AS date_dette,
        d.montant AS montantDette,
        COALESCE(SUM(p.montant_verse), 0) AS montantVerse,
        (d.montant - COALESCE(SUM(p.montant_verse), 0)) as montantRestant
    FROM 
        utilisateurs u
    LEFT JOIN 
        Dette d ON d.id_client = u.id
    LEFT JOIN 
        Paiments p ON p.id_dette = d.id
    WHERE 
        u.telephone = :telephone
    GROUP BY 
        u.id, u.nom, u.telephone, u.prenom, u.email, d.id, d.date, d.montant
    ORDER BY 
        d.date;";
        $data = ["telephone" => $telephone];

        // return $this->query($sql,$this->getEntity(),$data);
    
    }
    public function getDettesByUtilisateurPhone3($telephone, $filter = 'non_soldes') {
        $condition = "";
        if ($filter == 'soldes') {
            $condition = "HAVING montantRestant = 0";
        } else {
            $condition = "HAVING montantRestant > 0";
        }
    
        $sql = "SELECT 
                    d.id,
                    u.nom,
                    u.prenom,
                    u.email,
                    u.telephone,
                    d.date AS date_dette,
                    d.montant AS montantDette,
                    COALESCE(SUM(p.montant_verse), 0) AS montantVerse,
                    (d.montant - COALESCE(SUM(p.montant_verse), 0)) as montantRestant
                FROM 
                    utilisateurs u
                LEFT JOIN 
                    Dette d ON d.id_client = u.id
                LEFT JOIN 
                    Paiments p ON p.id_dette = d.id
                WHERE 
                    u.telephone = :telephone
                GROUP BY 
                    u.id, u.nom, u.telephone, u.prenom, u.email, d.id, d.date, d.montant
                $condition
                ORDER BY 
                    d.date;";
        
        $data = ["telephone" => $telephone];
        // return $this->query($sql, $this->getEntity(), $data);
    }
  
    
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        // return $this->query($sql,$this->getEntity(), ['id' => $id], true);
    }
    // inserer une nouvelle dette
    public function insertDette($data) {
        $sql = "INSERT INTO $this->table (id_client, montant) VALUES (:id_client, :montant)";
        $stmt = $this->database->prepare($sql,$data,$this->getEntity()); // Prépare la requête SQL
     
    }
    public function recuplastId(){

        $sql="SELECT MAX(id) as id_dette from Dette ;";
        $stmt=$this->database->getConnexion()->query($sql);
       return $stmt->fetch()['id_dette'];

    }
}