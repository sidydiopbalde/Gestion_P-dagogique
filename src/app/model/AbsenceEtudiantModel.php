<?php
namespace App\Model;
use Core\Model\Model;
use App\Entity\AbsenceEtudiantEntity;
class AbsenceEtudiantModel extends Model {
    
    protected string $table = 'Sessions';

    public function getEntity()
    {
        return AbsenceEtudiantEntity::class;
    }
   
    public function getAbsenceByEtudiantId($id_etudiant) {
        $sql = "SELECT a.*,m.libelle as module FROM `Absences` a 
        JOIN `Sessions` s ON s.id =a.id_session
        JOIN `Cours` c ON c.id = s.id_cours
        JOIN `Modules` m ON m.id = c.id_module
        Join `Etudiants` e on e.id= :id_etudiant;";
        $statement = $this->database->prepare($sql, ['id_etudiant' => $id_etudiant], $this->getEntity());
        return $statement;
    }
    public function justifierAbsenceById($id_absence,$motif,$piece){
        $sql="INSERT into Justication_Absence (motif,id_absence,piece_jointe) VALUES (:motif,:id_absence,:piece)";
        $statement = $this->database->prepare($sql, [
            'motif'=>$motif,
            'piece'=>$piece,
            'id_absence'=>$id_absence
        ],$this->getEntity());
        // return $statement->execute();
    }

}