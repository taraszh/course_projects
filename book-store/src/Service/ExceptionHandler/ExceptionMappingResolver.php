<?php

namespace App\Service\ExceptionHandler;

use http\Exception\InvalidArgumentException;

class ExceptionMappingResolver
{
    /**
     * @var ExceptionMapping[]
     */
    private array $mappings;

    public function __construct(array $mappings)
    {
        foreach ($mappings as $class => $mapping) {
            if (empty($mapping['code'])) {
                throw new InvalidArgumentException('code is mandatory for class: ' . $class);
            }

            $this->addMapping(
                $class,
                $mapping['code'],
                $mapping['hidden'] ?? true,
                $mapping['loggable'] ?? false,
            );
        }
    }

    private function addMapping(string $class, mixed $code, bool $hidden, bool $loggable): void
    {
        $this->mappings[$class] = new ExceptionMapping($code, $hidden, $loggable);
    }

    public function resolve(string $throwableClass): ?ExceptionMapping
    {
        $mappingFound = null;
        foreach ($this->mappings as $class => $mapping) {
            if ($throwableClass === $class || is_subclass_of($throwableClass, $class)) {
                $mappingFound = $mapping;
                break;
            }
        }

        return $mappingFound;
    }
}
