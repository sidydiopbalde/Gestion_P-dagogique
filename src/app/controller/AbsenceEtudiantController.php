<?php
namespace App\Controller;
use App\App;
use Core\Session;
use Core\Controller;
use Core\SessionInterface;
class AbsenceEtudiantController extends Controller{
    private $absencemodel;
    public function __construct(SessionInterface $session)
    {
        parent::__construct($session);
        $this->absencemodel = App::getInstance()->getModel("absenceEtudiant");
    }
    
    public function getAbsenceEtudiant(){
        $id_etudiant=Session::get('etudiant_id');
        $absences=$this->absencemodel->getAbsenceByEtudiantId($id_etudiant);
        // echo '<pre>';
        // var_dump($id_etudiant,'absence',$absences);die;
        // echo '</pre>';
        $this->renderView('Liste_Absence',['absences'=> $absences]);
    }  
    public function justifierAbsence(){
        $absenceId = $_POST['idSession'] ?? '';
        $motif = $_POST['motif'] ?? '';
        $piece = $_POST['piece'] ?? '';
        var_dump($absenceId,$motif,$piece);
        $this->absencemodel->justifierAbsenceById($absenceId,$motif,$piece);
        echo "Absence justifié avec succés!!!!";
    }  
}