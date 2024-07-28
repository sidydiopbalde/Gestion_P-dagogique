<?php

namespace App\App\Controller;
use Core\Validator\Validator;
use App\App;
use Core\Controller;
use Core\Validator\Validator1;
class UtilisateurController extends Controller{

    private $utilisateurModel;
    private $detteModel;
    private $paiementModel;
    public $validator;

    public function __construct(){
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->paiementModel = App::getInstance()->getModel("paiement");
        // $this->validator=new Validator1();
    }

 
  public function searchClientByTel () {
        $tel = getPostTel();
        $clients = $this->utilisateurModel->search($tel);
        $error='';
        if(empty($clients->id)){
            $error='client not found';
        } 
    
        $this->renderView('Client_SuivieDette',['clients' => $clients,'error'=>$error]);
 }
    public function index(){
        
        $clients = $this->utilisateurModel->all();
       
        $this->renderView('Client_SuivieDette', ['clients' => $clients]);
    } 
    public function login(){
        $clients = $this->utilisateurModel->all();
       
        $this->renderView('login', ['clients' => $clients]);
    } 
 
    public function redir(){
        $this->redirect("Client_SuivieDette.php");
    }

    public function addClient() {
   
      
        $data = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'tel' => $_POST['tel'],
            'photo' => isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK ? $_FILES['photo']['name'] : 'user.jpeg',
            'motDePasse'=> password_hash("passer123", PASSWORD_BCRYPT),
        ]; 
          
    

        $rules = [
            'nom' => 'required|min:3|max:50',
            'prenom' => 'required|min:3|max:50',
            'email' => 'email|required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'tel' => 'tel|required|regex:/^[0-9]{9}$/'
     
        ];
        // Créer une instance de Validator et valider les données
         $validator = new Validator();
        
    //  $errors=   $this->validator->validate($_POST,[
    //         'nom'=>['required','min:3', "max:50"],
    //         'prenom'=>['required','min:3', "max:50"],
    //         'email'=>['required','email'],
    //         'tel'=>['required','phone']

    //     ]);
    //     var_dump($errors);
    //     die();
        $validator->validate($data, $rules);

        if ($validator->fails()) {
            // Renvoyer les erreurs à la vue
            $errors = $validator->errors();
            // Re-rendre la vue du formulaire avec les erreurs
            $this->renderView('Client_SuivieDette', ['errors' => $errors,'old' => $data]);
        } else {
            // Sauvegarder les données si la validation est réussie
            move_uploaded_file($_FILES['photo']['tmp_name'], '/var/www/html/gestiondette3/public/IMG/'. $_FILES['photo']['name']);
            if(!$this->utilisateurModel->findByPhone($_POST['tel']) || !$this->utilisateurModel->findByMail($_POST['email'])){

                $this->utilisateurModel->save($data);
            }
            $clients = $this->utilisateurModel->all();
            $this->renderView('Client_SuivieDette', ['clients' => $clients]);
        }
    }
    public function getAllUtilisateur(){
        $clients=$this->utilisateurModel->all();
       
        return  $clients;
    }
 

}

function getPostTel(){

    return $_POST['phone'];
}