<?php

namespace App\Core;

class DependencyFactory
{
    public static function create($className, Container $container)
    {
        $reflectionClass = new \ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new \Exception("Class {$className} is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();
        if (is_null($constructor)) {
            return new $className();
        }

        $parameters = $constructor->getParameters();
        $dependencies = array_map(function ($param) use ($container) {
            $type = $param->getType();
            if ($type === null) {
                throw new \Exception("Cannot resolve class dependency {$param->name}");
            }
            return $container->get($type->getName());
        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
