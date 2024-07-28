<?php

use Core\Route;
require_once '/var/www/html/Gestion_Pedagogique/vendor/autoload.php';
require_once '/var/www/html/Gestion_Pedagogique/src/config/config.php';   


use App\App\App;


$route = new Route();
// echo 'bismillah';
$route->get('listeCours',['controller'=>'ListeCoursController','action'=>'index']);
$route->post('listeCours',['controller'=>'ListeCoursController','action'=>'index']);
$route->get('login',['controller'=>'LoginController','action'=>'showLogin']);
$route->get('Session',['controller'=>'SessionController','action'=>'getSessionsProf']);
$route->post('login',['controller'=>'LoginController','action'=>'showLogin']);
$route->post('annulerSession',['controller'=>'AnnulerSessionController','action'=>'CancelSession']);
//Etudiant
$route->get('listeCoursEtudiant',['controller'=>'ListeCoursEtudiantController','action'=>'listCoursEtudiant']);
$route->post('listeCoursEtudiant',['controller'=>'ListeCoursEtudiantController','action'=>'listCoursEtudiant']);
$route->get('SessionEtudiant',['controller'=>'SessionEtudiantController','action'=>'getSessionsEtudiant']);
$route->get('AbsenceEtudiant',['controller'=>'AbsenceEtudiantController','action'=>'getAbsenceEtudiant']);
//confirmer présence
if(isset($_POST['Id_Confirm_Presence'])){
    $route->post('SessionEtudiant',['controller'=>'SessionEtudiantController','action'=>'confirmPresenceEtudiant']);
}
if(isset($_POST['piece'])){
   
    $route->post('AbsenceEtudiant',['controller'=>'AbsenceEtudiantController','action'=>'justifierAbsence']);
}

//logout
$route->get('logout',['controller'=>'LoginController','action'=>'logout']);

$route::separate();
  

