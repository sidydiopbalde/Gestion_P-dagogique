<?php
namespace Core\Entity;

use \ReflectionClass;

interface EntityInterface {
    public function __get($property);
    public function __set($property, $value);
}

abstract class Entity implements EntityInterface {
    public function __get($property) {
        $reflector = new ReflectionClass($this);
        if ($reflector->hasProperty($property)) {
            $propertyReflector = $reflector->getProperty($property);
            $propertyReflector->setAccessible(true);
            return $propertyReflector->getValue($this);
        } else {
            throw new \Exception("Propriété '$property' inexistante dans la classe " . get_class($this));
        }
    }

    public function __set($property, $value) {
        $reflector = new ReflectionClass($this);
        if ($reflector->hasProperty($property)) {
            $propertyReflector = $reflector->getProperty($property);
            $propertyReflector->setAccessible(true);
            $propertyReflector->setValue($this, $value);
        } else {
            throw new \Exception("Propriété '$property' inexistante dans la classe " . get_class($this));
        }
    }
}
?>
