<?php
require_once '/var/www/html/Gestion_Pedagogique/vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable('/var/www/html/Gestion_Pedagogique');
$dotenv->load();

// Pour lire un fichier YAML
$data = Yaml::parseFile('/var/www/html/Gestion_Pedagogique/src/config/services.yaml');

define('WEB','/var/www/html/Gestion_Pedagogique/src');
define('DB_USER',$_ENV['DB_USER']);
define('DB_HOST','localhost');
define('DB_NAME','Mon_Ecole');
define('DB_PASSWORD',$_ENV['DB_PASSWORD']);
define('WEBROOT','http://www.sidy.diop.balde:8012/Gestion_Pedagogique/public/');
define('dsn','mysql:host=localhost;port=3306;dbname=Mon_Ecole;charset=utf8mb4');


