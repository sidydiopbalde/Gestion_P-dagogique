<?php

namespace App;

require_once '/var/www/html/Gestion_Pedagogique/src/config/config.php';

use Core\Database\MysqlDatabase;


class App{
    private static $instance;
    private $database;
    
    public function __construct(){

    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDatabase(){
        if ($this->database === null) {
            
            $this->database =new MysqlDatabase();
        }
        return $this->database;
    }

    public function getModel($model)
    {
        $modelClass = "App\\Model\\" . ucfirst($model) . "Model";
        $newModel = new $modelClass();
        $newModel->setDatabase($this->getDatabase());
        
        return $newModel;
    }

    public function notFound(){

    }

    public function forbidden(){
     
    }
}