<?php

namespace Core\Database;

use PDO;
use PDOException;
use Symfony\Component\Yaml\Yaml;


class MysqlDatabase implements MysqlDatabaseInterface{

    private $pdo;

    public function __construct() {
        
        $data = Yaml::parseFile('/var/www/html/Gestion_Pedagogique/src/config/services.yaml');
        // var_dump(new $data['MysqlDatabase']);
        $dsn=$data['dsn'];
        $user=$data['DB_USER'];
        $password=$data['DB_PASSWORD'];
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
            //echo "Connexion à la base de données réussie";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

    }
    public function getConnexion() {
    return $this->pdo;    
    }
    public function prepare(string $sql,array $data, string $entityName, bool $single = false)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName);
        if ($single) {
            return $stmt->fetch();
        }
        return $stmt->fetchAll();
    }

    public function query(string $sql, string $entityName, bool $single = false)
    {
        $stmt = $this->pdo->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName);
        if ($single) {
            return $stmt->fetch();
        }
        return $stmt->fetchAll();
    }
}