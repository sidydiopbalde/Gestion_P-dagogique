<?php

namespace Core\Model;


interface ModelInterface {
    public function all();
    public function find();
    public function findByPhone($telephone);
    public function query(string $sql, string $entityName, $data = [], bool $single = false);
    public function delete();
    public function save($data);
    public static function update();
    public function setDatabase($database);
    public function getEntity();
    public function hasMany($relatedModel, $foreignKey, $localKey);
    public function belongsTo($relatedModel, $foreignKey, $ownerKey);
    public function belongsToMany($relatedModel, $pivotTable, $foreignKey, $relatedKey, $localKey);
}