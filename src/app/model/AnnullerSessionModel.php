<?php
namespace App\Model;
use Core\Model\Model;
use App\Entity\AnnullerSessionEntity;
class AnnullerSessionModel extends Model {
    
    protected string $table = 'Sessions';

    public function getEntity()
    {
        return AnnullerSessionEntity::class;
    }
    public function AnnulerSession($sessionId) {
        
            $sql = "UPDATE {$this->table} SET statut = 'annulle' WHERE id = :sessionId";
            $statement = $this->database->prepare($sql, ['sessionId' => $sessionId], $this->getEntity()); 

    }
    public function SaveAnnulationSession($motif,$id_prof,$id_session){
        $sql="INSERT into Demande_Annulation (motif,id_prof,id_session) VALUES (:motif,:id_prof,:id_session)";
        $statement = $this->database->prepare($sql, [
            'motif'=>$motif,
            'id_prof'=>$id_prof,
            'id_session'=>$id_session
        ],$this->getEntity());
        return $statement->execute();
    }
    public function getSessionsByProfId($prof_id) {
        $sql = "SELECT s.*,m.libelle as module FROM   `Sessions` s 
        JOIN `Cours` c ON c.id= s.id_cours
        JOIN `Modules` m ON m.id=c.id_module
        WHERE c.id_prof=:prof_id";
        $statement = $this->database->prepare($sql, ['prof_id' => $prof_id], $this->getEntity());
        return $statement;
    }

}