<?php
namespace App\Controller;
use App\App;
use Core\Session;
use Core\Controller;
use Core\SessionInterface;

class SessionController extends Controller{
    private $sessionmodel;
    public function __construct(SessionInterface $session)
    {
        parent::__construct($session);
        $this->sessionmodel = App::getInstance()->getModel("session");
    }
      
        public function getSessionsProf(){
            $prof_id = Session::get('prof_id');
            $sessions = $this->sessionmodel->getSessionsByProfId($prof_id);
            // echo '<pre>';
            // var_dump($sessions,$prof_id);
            // echo '</pre>';
            $this->renderView('Session_Cours', [
                'sessions' => $sessions
            ]);

        }
        
        
}