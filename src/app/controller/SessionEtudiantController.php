<?php
namespace App\Controller;
use App\App;
use Core\Session;
use Core\Controller;
use Core\SessionInterface;

class SessionEtudiantController extends Controller{
    private $sessionmodel;
    public function __construct(SessionInterface $session)
    {
        parent::__construct($session);
        $this->sessionmodel = App::getInstance()->getModel("sessionEtudiant");
    }
    public function getSessionsEtudiant(){
        $etudiant_id=Session::get('etudiant_id');
        $sessions = $this->sessionmodel->getSessionsByEtudiantId($etudiant_id);
        // echo '<pre>';
        // var_dump($sessions);
        // echo '</pre>';
        $this->renderView('Session_Cours_Etudiant', [
            'sessions' => $sessions
        ]);
    }
     public function confirmPresenceEtudiant()
     {
        $session_Id = $_POST['Id_Confirm_Presence'] ?? '';
        $this->sessionmodel->confirmPresenceBySessionId($session_Id);
        echo "Marqué présent avec succés";
        // var_dump($session_Id,$confirm);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
     }   
}