<?php
namespace App\Model;
use Core\Model\Model;
use App\Entity\ListeCoursEntity;

class ListeCoursEtudiantModel extends Model
{
    protected string $table = 'Cours';

   
    public function getEntity()
    {
         return ListeCoursEntity::class;
    }
  
 
    public function getCoursByEtudiantId($id, $limit, $offset, $module = null, $semestre = null) {
        $sql = "SELECT 
                    c.id, 
                    e.id ,
                    s.libelle AS semestre,
                    cl.libelle AS classe,
                    m.libelle AS module,
                    c.nombreHeure,
                    u.nom, 
                    u.prenom
                FROM 
                    Cours c
                JOIN 
                    Cours_Classes cc ON cc.id_cours = c.id
                JOIN 
                    Classes cl ON cc.id_classe = cl.id
                JOIN 
                    Etudiants e ON e.id_classe = cl.id
                JOIN 
                    Modules m ON c.id_module = m.id
                JOIN 
                    Utilisateurs u ON u.id = e.id_user
                JOIN 
                    Semestre s ON c.id_semestre = s.id
                WHERE 
                    e.id = :id";
        
        $params = [
            'id' => $id
        ];
    
        if ($module) {
            $sql .= " AND m.libelle LIKE :module";
            $params['module'] = '%' . $module . '%';
        }
    
        if ($semestre) {
            $sql .= " AND s.libelle LIKE :semestre";
            $params['semestre'] = '%' . $semestre . '%';
        }
    
        // Ajouter la limite et le décalage directement dans la requête
        $sql .= " LIMIT $limit OFFSET $offset";
        
        return $this->query($sql, $this->getEntity(), $params);
       
    
    
    }
    
    public function getTotalCoursByEtudiantId($id) {
        $sql = "SELECT COUNT(*) as total 
        FROM Cours c
        JOIN Cours_Classes cc ON cc.id_cours = c.id
        JOIN Classes cl ON cc.id_classe = cl.id
        JOIN Etudiants e ON e.id_classe = cl.id
        WHERE e.id = :id;
";
        $params = ['id' => $id];
        $result = $this->query($sql, $this->getEntity(), $params);
        return $result[0]->getTotal();
    }
    
}