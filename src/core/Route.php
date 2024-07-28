<?php
namespace Core;

use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

class Route {
    public static $routes = [];

    public static function get($uri, $controllerAction) {
        self::$routes['GET'][$uri] = $controllerAction;
    }

    public static function post($uri, $controllerAction) {
        self::$routes['POST'][$uri] = $controllerAction;
    }

    public static function separate() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $queryParams = [];
      
        
        if (isset(self::$routes[$method][$uri])) {
            $route = self::$routes[$method][$uri];
            
            if (is_array($route) && isset($route['controller']) && isset($route['action'])) {
                $controllerClass = "App\\Controller\\{$route['controller']}";
                $action = $route['action'];
                
                try {
                    // Vérifier l'existence de la classe avec Reflection
                    $reflector = new ReflectionClass($controllerClass);
                    
                    // Vérifier l'existence de la méthode dans la classe avec Reflection
                    if ($reflector->hasMethod($action)) {
                        $constructor = $reflector->getConstructor();
                        $params = [];
                        
                        if ($constructor) {
                            $constructorParams = $constructor->getParameters();
                            foreach ($constructorParams as $param) {
                                $paramType = $param->getType();
                                if ($paramType && !$paramType->isBuiltin()) {
                                    $paramClass = new ReflectionClass($paramType->getName());
                                    if ($paramClass->implementsInterface(SessionInterface::class)) {
                                        $params[] = ProviderServices::getInstance()->getSession();
                                    } else {
                                        $params[] = null; // Pour les autres dépendances, à gérer selon votre logique
                                    }
                                } else {
                                    $params[] = null; // Pour les types scalaires, à gérer selon votre logique
                                }
                            }
                        }

                        // Créer une instance du contrôleur avec les paramètres injectés
                        $controller = $reflector->newInstanceArgs($params);
                        $method = $reflector->getMethod($action);
                        
                        if ($method->isPublic()) {
                            // Ajouter les paramètres de requête à l'appel de la méthode
                            $methodParams = [];
                            foreach ($method->getParameters() as $param) {
                                $paramName = $param->getName();
                                if (isset($queryParams[$paramName])) {
                                    $methodParams[] = $queryParams[$paramName];
                                } else {
                                    $methodParams[] = null; // ou une valeur par défaut
                                }
                            }
                            $method->invokeArgs($controller, $methodParams);
                        } else {
                            echo "L'action '{$action}' n'est pas accessible dans le contrôleur '{$controllerClass}'.";
                        }
                    } else {
                        echo "L'action '{$action}' n'existe pas dans le contrôleur '{$controllerClass}'.";
                    }
                } catch (ReflectionException $e) {
                    echo "Le contrôleur '{$controllerClass}' n'existe pas.";
                }
            } else {
                echo 'Format de route invalide.';
            }
        } else {
            echo 'Page 404';
        }
    }
}
