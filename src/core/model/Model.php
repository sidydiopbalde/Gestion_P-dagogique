<?php

namespace Core\Model;




 abstract class Model implements ModelInterface{

    protected string $table;
    protected $database;

    public function __construct(){
      // $this->database = $database;
    }


    public function all(){
    
      return $this->database->query("select * from $this->table", $this->getEntity());
    }

    public function find(){

    }
    public function findByPhone($telephone){
      
    }
    public function query(string $sql, string $entityName, $data = [], bool $single = false){
      if(empty($data)){
        return $this->database->query($sql, $entityName, $single);
      }else{
        return $this->database->prepare($sql, $data, $entityName, $single);
      }
      
    }

    public function delete(){

    }

    public function save($data){

    }

    public static function update(){

    }

    public function setDatabase($database){
      $this->database = $database;
    }

    public abstract function getEntity();

    //Relation one-to-many
    public function hasMany($relatedModel, $foreignKey, $localKey){
      $relatedModelInstance = new $relatedModel($this->database);
      $sql = "SELECT * FROM " . $relatedModelInstance->table . " WHERE $foreignKey = :id";
      var_dump($sql);
      
      return $this->database->prepare($sql, ['id' => $localKey], $relatedModelInstance->getEntity());
   }

   //relation many-to-One
   public function belongsTo($relatedModel, $foreignKey, $ownerKey) {
      $relatedModelInstance = new $relatedModel($this->database);
      $sql = "SELECT * FROM " . $relatedModelInstance->table . " WHERE id = :id";
      return $this->database->prepare($sql, ['id' => $foreignKey], $relatedModelInstance->getEntity(), true);
   }
//Relation many-to-many
   public function belongsToMany($relatedModel, $pivotTable, $foreignKey, $relatedKey, $localKey){
      $relatedModelInstance = new $relatedModel($this->database);
      $sql = "SELECT * FROM " . $relatedModelInstance->table . " 
            INNER JOIN $pivotTable ON " . $relatedModelInstance->table . ".id = $pivotTable.$relatedKey
            WHERE $pivotTable.$foreignKey = :id";
      return $this->database->prepare($sql, ['id' => $localKey], $relatedModelInstance->getEntity());
   }

   public function transaction(callable $method){
     $pdo = $this->database->getConnexion();
      try {
        $pdo->beginTransaction();
        $method();
        $pdo->commit();

      } catch (\Exception $e) {
        //throw $th;
        $pdo->rollBack();
      }
   }
 }