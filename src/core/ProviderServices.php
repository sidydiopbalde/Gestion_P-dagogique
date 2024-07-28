<?php
namespace Core;
use Symfony\Component\Yaml\Yaml;
use Core\ValidatorInterface;
use Core\SessionInterface;

class ProviderServices {
    private static $instance;
    private $services = [];
    private $config;

    private function __construct()
    {
        $this->loadConfig();
    }

    private function loadConfig()
    {
        $configPath = '/var/www/html/Gestion_Pedagogique/src/config/services.yaml';
        if (!file_exists($configPath)) {
            throw new \Exception("Le fichier de configuration n'existe pas : $configPath");
        }
        $this->config = Yaml::parseFile($configPath);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getService($serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            if (!isset($this->config['Services'][$serviceName])) {
                throw new \Exception("Service non configuré : $serviceName");
            }
            $className = $this->config['Services'][$serviceName]['class'];
            if (!class_exists($className)) {
                throw new \Exception("Classe non trouvée pour le service $serviceName : $className");
            }
            $this->services[$serviceName] = new $className();
        }
        return $this->services[$serviceName];
    }

    // public function getValidator(): ValidatorInterface
    // {
    //     return $this->getService(ValidatorInterface::class);
    // }

    public function getSession(): SessionInterface
    {
        return $this->getService(SessionInterface::class);
    }
}