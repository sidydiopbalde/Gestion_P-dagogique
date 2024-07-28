<?php
namespace App\Controller;
use App\App;
use Core\Controller;
use Core\Validator;
use Core\Session;
use Core\SessionInterface;



class AnnulerSessionController extends Controller {
    private $annullerSession;

  
    public function __construct(SessionInterface $session)
    {
        parent::__construct($session);
        $this->annullerSession = App::getInstance()->getModel("annullerSession");
      
    }
      
    public function CancelSession()
    {
        $sessionId = $_POST['idSession'] ?? '';
        $motif = $_POST['cancelReason'] ?? '';
        $prof_id = Session::get('prof_id');
        // var_dump($motif,$sessionId,$prof_id );die;
        $sessions = $this->annullerSession->getSessionsByProfId($prof_id);
        $this->annullerSession->AnnulerSession($sessionId);
        $this->annullerSession->SaveAnnulationSession($motif,$prof_id,$sessionId);
        // header('location: Session_Cours');
         $this->renderView('Session_Cours', ['sessions' =>  $sessions]);
    }
}