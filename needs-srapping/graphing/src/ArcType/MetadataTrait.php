<?php

namespace Jollyblume\Component\Graphing\ArcType;

use ReflectionClass;
use ReflectionMethod;
use InvalidArgumentException;
use Jollyblume\Component\Graphing\ArcType\ArcTypeInterface;
use Jollyblume\Component\Graphing\ArcType\Definition;
use Jollyblume\Component\Graphing\Resolver\FilterResolverTrait;

trait MetadataTrait
{
    /**
     * @var array $definitions
     */
    private $definitions;

    protected function discoverImplementedArcTypes() : array
    {
        $arcTypes = [];
        $interfaces = class_implements($this);
        foreach ($interfaces as $arcType) {
            if (ArcTypeInterface::class === $arcType) {
                // INVALID_ARCTYPE
                continue;
            }
            $rArcType = new ReflectionClass($arcType);
            if (!$rArcType->implementsInterface(ArcTypeInterface::class)) {
                // NOT_AN_ARCTYPE
                continue;
            }
            $arcTypes[] = $arcType;
        }
        return $arcTypes;
    }

    protected function addDiscoveredArcTypes(array $arcTypes)
    {
        $definitions = $this->definitions;
        if (null === $definitions) {
            $definitions = [];
        }
        foreach ($arcTypes as $arcType) {
            $definitions[$arcType] = new Definition($arcType, $this);
        }
        $this->definitions = $definitions;
    }

    public function supportsArcType(string $arcType) : bool
    {
        if (!interface_exists($arcType)) {
            // NOT_AN_INTERFACE
            return false;
        }
        if (ArcTypeInterface::class === $arcType) {
            // INVALID_ARCTYPE
            return false;
        }
        $rArcType = new ReflectionClass($arcType);
        if (!$rArcType->implementsInterface(ArcTypeInterface::class)) {
            // NOT_AN_ARCTYPE
            return false;
        }
        if ($this instanceof $arcType) {
            // IMPLEMENTED_ARCTYPE
            return true;
        }
        // HACK
        $rArcType = new ReflectionClass($arcType);
        $arcTypeMethods = $rArcType->getMethods(ReflectionMethod::IS_PUBLIC);
        $methods = array_values(array_map(
            function ($method) {
                /** @var ReflectionMethod $method */
                return $method->getName();
            },
            $arcTypeMethods
        ));
        $rThis = new ReflectionClass($this);
        foreach ($methods as $method) {
            if ($rThis->hasMethod($method)) {
                continue;
            }
            return false;
        }
        return true;
    }

    public function getDefinitions() : array
    {
        $definitions = $this->definitions;
        if (null === $definitions) {
            $implementedArcTypes = $this->discoverImplementedArcTypes();
            $this->addDiscoveredArcTypes($implementedArcTypes);
            $definitions = $this->definitions;
        }
        return $definitions;
    }

    public function isSourceNode()
    {
        return 0 !== count($this->getDefinitions());
    }

    public function hasDefinitions(string $arcTypeFilter = '') : bool
    {
        if (empty($arcTypeFilter)) {
            return $this->isSourceNode();
        }
        $definitions = $this->getDefinitions();
        $undiscoveredArcTypes = [];
        $this->partitionFilter($arcTypeFilter, $definitions, $undiscoveredArcTypes);
        $unknownArcTypes = [];
        $discoveredArcTypes = [];
        foreach ($undiscoveredArcTypes as $arcType) {
            if (true === $this->supportsArcType($arcType)) {
                $discoveredArcTypes[] = $arcType;
                continue;
            }
            $unknownArcTypes[] = $arcType;
        }
        $this->addDiscoveredArcTypes($discoveredArcTypes);
        return empty($unknownArcTypes);
    }
}
