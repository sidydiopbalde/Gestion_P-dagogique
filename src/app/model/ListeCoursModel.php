<?php
namespace App\Model;
use Core\Model\Model;
use App\Entity\ListeCoursEntity;

class ListeCoursModel extends Model
{
    protected string $table = 'Cours';

   
    public function getEntity()
    {
         return ListeCoursEntity::class;
    }
  
    public function getCoursByProfId($id, $limit, $offset) {
        $sql = "SELECT c.id, s.libelle as semestre,cl.libelle as classe,m.libelle as module,c.nombreHeure,
        p.grade,p.specialite,u.nom, u.prenom 
                   FROM `Cours` c
                       JOIN `Modules` m ON c.id_module = m.id
                       JOIN `Classes` cl 
                       JOIN `Cours_Classes` cc ON cc.id_cours = c.id AND cc.id_classe=cl.id
                       JOIN `Professeurs` p ON p.id_user = c.id_prof
                       JOIN `Utilisateurs` u ON u.id = p.id_user
                       JOIN `Semestre` s ON c.id_semestre = s.id
                       WHERE c.id_prof = :id
                LIMIT :limit OFFSET :offset";
        $params = [
            'id' => $id,
            'limit' => $limit,
            'offset' => $offset
        ];
        return $this->query($sql, $this->getEntity(), $params);
    }
    
    public function getTotalCoursByProfId($id) {
        $sql = "SELECT COUNT(*) as total FROM `Cours` c WHERE c.id_prof = :id";
        $params = ['id' => $id];
        $result = $this->query($sql, $this->getEntity(), $params);
        return $result[0]->getTotal();
    }
    
    public function getCoursByProfId1($id, $limit, $offset, $module = null, $semestre = null) {
        $sql = "SELECT c.id, s.libelle as semestre,cl.libelle as classe,m.libelle as module,c.nombreHeure,
        p.grade,p.specialite,u.nom, u.prenom 
                   FROM `Cours` c
                       JOIN `Modules` m ON c.id_module = m.id
                       JOIN `Classes` cl 
                       JOIN `Cours_Classes` cc ON cc.id_cours = c.id AND cc.id_classe=cl.id
                       JOIN `Professeurs` p ON p.id_user = c.id_prof
                       JOIN `Utilisateurs` u ON u.id = p.id_user
                       JOIN `Semestre` s ON c.id_semestre = s.id
                       WHERE c.id_prof = :id";
         
        $params = [
            'id' => $id,
            'limit' => $limit,
            'offset' => $offset
        ];
    
        if ($module) {
            $sql .= " AND m.libelle LIKE :module";
            $params['module'] = '%' . $module . '%';
        }
    
        if ($semestre) {
            $sql .= " AND s.libelle LIKE :semestre";
            $params['semestre'] = '%' . $semestre . '%';
        }
    
        $sql .= " LIMIT :limit OFFSET :offset";
    
        return $this->query($sql, $this->getEntity(), $params);
    }
    
    
}