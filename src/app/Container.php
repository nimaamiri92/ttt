<?php

namespace App;

use ReflectionClass;

class Container
{
    protected array $dependencyList = [];

    public function bind(string $abstract, $concrete): void
    {
        if (!isset($this->dependencyList[$abstract])) {
            $this->dependencyList[$abstract] = $concrete;
        }
    }

    function resolveDependecy(string $class)
    {
        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
        $dependency = $this->dependencyList[$reflectionClass->getName()] ?? null;

        //if the class already resolved
        if (is_object($dependency)){
            return $this->dependencyList[$reflectionClass->getName()];
        }

        //resolve defined interface
        if ($reflectionClass->isInterface()) {
            return $this->resolveDependecy(
                $this->dependencyList[$reflectionClass->getName()]
            );
        }

        // No constructor, return an instance without dependencies
        if (!$constructor) {
            return $reflectionClass->newInstance();
        }

        $dependencies = [];
        $parameters = $constructor->getParameters();

        foreach ($parameters as $parameter) {
            $dependencyClass = $parameter->getType();

            if ($dependencyClass && !$dependencyClass->isBuiltin()) {
                $dependencies[] = $this->resolveDependecy($dependencyClass->getName());
            } else {
                $dependencies[] = $parameter->getDefaultValue();
            }
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
