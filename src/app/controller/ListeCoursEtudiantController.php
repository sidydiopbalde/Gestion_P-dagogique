<?php
namespace App\Controller;
use App\App;
use Core\Session;
use Core\Controller;
use Core\SessionInterface;
class ListeCoursEtudiantController extends Controller{
    private $coursmodel;
    public function __construct(SessionInterface $session)
    {
        parent::__construct($session);
        $this->coursmodel = App::getInstance()->getModel("listeCoursEtudiant");
    }
      
        public function listCoursEtudiant(){
            $etudiant_id = Session::get('etudiant_id');
            // var_dump($etudiant_id);die;
            $filterModule = isset($_POST['filterModule']) ? trim($_POST['filterModule']) : '';
            $filterSemestre = isset($_POST['filterSemestre']) ? trim($_POST['filterSemestre']) : '';            
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 2; 
            $offset = ($page - 1) * $limit;

            $cours = $this->coursmodel->getCoursByEtudiantId($etudiant_id, $limit, $offset,$filterModule, $filterSemestre);
            if($cours){
                $totalCours = $this->coursmodel->getTotalCoursByEtudiantId($etudiant_id);
           
                $totalPages = ceil($totalCours / $limit);
             
            
                $this->renderView('ListeCoursEtudiant', [
                    'cours' => $cours,
                    'totalPages' => $totalPages,
                    'currentPage' => $page
            ]);
            }else{
                $this->renderView('ListeCoursEtudiant', []);
            }

            // $cours = $this->coursmodel->getCoursByProfId($prof_id, $limit, $offset);
            // echo '<pre>';
            // var_dump($cours);
            // echo '</pre>';
          
        }
       
        
}