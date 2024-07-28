<?php
namespace App\Controller;
use App\App;
use Core\Controller;
use Core\Validator;
use Core\Session;
use Core\SessionInterface;

class LoginController extends Controller {
    private $loginModel;

  
    public function __construct(SessionInterface $session)
    {
        parent::__construct($session);
        $this->loginModel = App::getInstance()->getModel("login");
      
    }
  
    public function showLogin()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        $error_email='';
        $error_password='';
        if(isset($_POST['login']) && empty($login)){
            $error_email='Email obligatoire';
        }
        if(isset($_POST['password']) && empty($password)){
            $error_password='Mot de passe obligatoire';
        }
        $error_all='';
        if (!empty($login) && !empty($password)) {
            $user = $this->loginModel->checkCredentials($login, $password);
            if ($user) {
                if ($user->getIdRole() == 2) { 
                    Session::set('prof_id', $user->getID());
                    header('location: listeCours');
                    exit();
                } else if ($user->getIdRole() == 3) { 
                    
                    $etudiantId = $this->loginModel->getEtudiantId($user->getID());
                    
                    Session::set('etudiant_id', $etudiantId[0]->getId());
                    // echo '<pre>';
                    // var_dump(Session::get('etudiant_id'),$etudiantId,$etudiantId[0]->getId());die;
                    // echo '</pre>';
                    header('location: listeCoursEtudiant');
                    exit();
                }
            } else {
                $error_all = 'Email ou mot de passe invalide';
            }
        }

        $this->renderView('Login',[
         'error_email' => $error_email,
         'error_password'=>$error_password,
         'error_all'=>$error_all
        ]);
    }
    public function register()
    {
        // Exemple d'inscription d'un utilisateur
        $prenom = 'Fallou';
        $nom = 'Diop';
        $email = 'falloudiop@gmail.com';
        $telephone = '784325647';
        $password = 'passer123';
        $id_role = 3; 
        $this->loginModel->registerUser($prenom, $nom, $email, $telephone, $password, $id_role);
        $this->renderView('Login', ['client' => 'SIDY DIOP BALDE']);
    }
    
    public function logout(){
        Session::close();
        header('location: login');
        exit();
    }
}
?>

