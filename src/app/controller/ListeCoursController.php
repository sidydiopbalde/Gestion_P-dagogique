<?php
namespace App\Controller;
use App\App;
use Core\Session;
use Core\Controller;
use Core\SessionInterface;
class ListeCoursController extends Controller{
    private $coursmodel;
    public function __construct(SessionInterface $session)
    {
        parent::__construct($session);
        $this->coursmodel = App::getInstance()->getModel("listeCours");
    }
      
        public function index(){
            $prof_id = Session::get('prof_id');
            $filterModule = isset($_POST['filterModule']) ? trim($_POST['filterModule']) : '';
            $filterSemestre = isset($_POST['filterSemestre']) ? trim($_POST['filterSemestre']) : '';
            
            // var_dump($filterModule,$filterSemestre);
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 4; 
            $offset = ($page - 1) * $limit;
            $cours = $this->coursmodel->getCoursByProfId1($prof_id, $limit, $offset, $filterModule, $filterSemestre);
            if($cours){
                $totalCours = $this->coursmodel->getTotalCoursByProfId($prof_id);
           
                $totalPages = ceil($totalCours / $limit);
             
            
                $this->renderView('ListeCours', [
                    'cours' => $cours,
                    'totalPages' => $totalPages,
                    'currentPage' => $page
            ]);
            }else{
                $this->renderView('ListeCours', []);
            }

          
        }
      
        
}