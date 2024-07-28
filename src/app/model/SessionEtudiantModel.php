<?php
namespace App\Model;
use Core\Model\Model;
use App\Entity\SessionEntity;

class SessionEtudiantModel extends Model
{
    protected string $table = 'Sessions';

    public function getEntity()
    {
         return SessionEntity::class;
    }
  
    public function getSessionsByEtudiantId($id) {
        $sql = "SELECT s.*, m.libelle AS module
        FROM `Sessions` s 
        JOIN `Cours` c ON c.id = s.id_cours
        JOIN `Cours_Classes` cc ON cc.id_cours = c.id
        JOIN `Classes` cl ON cl.id = cc.id_classe
        JOIN `Etudiants` e ON e.id_classe = cl.id
        JOIN `Modules` m ON c.id_module = m.id
        WHERE e.id = :id";
        $statement = $this->database->prepare($sql, ['id' => $id], $this->getEntity());
        return $statement;
    }
    
    public function confirmPresenceBySessionId($session_id)
    {
        $sql = "UPDATE Absences SET etat = 'present' WHERE id_session = :session_id";
        $statement = $this->database->prepare($sql, ['session_id' => $session_id], $this->getEntity()); 
    }
    
}