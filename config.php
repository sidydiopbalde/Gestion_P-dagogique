<?php
require '/var/www/html/Gestion_Pedagogique/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable('/var/www/html/Gestion_Pedagogique');
$dotenv->load();

define('DB_USER',$_ENV['DB_USER']);
define('DB_PASSWORD',$_ENV['DB_PASSWORD']);
define('WEBROOT','www.sidy.diop.balde.sn:8O10/Gestion_Pedagogique/public/');
define('dsn','mysql:host=localhost;port=3306;dbname=Mon_Ecole;charset=utf8mb4');


