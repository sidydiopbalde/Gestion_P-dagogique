<?php
namespace App\Model;
use Core\Model\Model;
use App\Entity\SessionEntity;

class SessionModel extends Model
{
    protected string $table = 'Sessions';

    public function getEntity()
    {
         return SessionEntity::class;
    }
  
    public function getSessionsByProfId($prof_id) {
        $sql = " SELECT s.*,m.libelle as module FROM   `Sessions` s 
        JOIN `Cours` c ON c.id= s.id_cours
        JOIN `Modules` m ON m.id=c.id_module
        WHERE c.id_prof=:prof_id;";
        $statement = $this->database->prepare($sql, ['prof_id' => $prof_id], $this->getEntity());
        return $statement;
    }
    

    
}