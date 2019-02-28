<?php

namespace Jollyblume\Bundle\GraphBundle\Metadata;

use Jollyblume\Bundle\GraphBundle\Traits\TokenChoicesFilterTrait;
use Jollyblume\Bundle\GraphBundle\Type\ArcTypeInterface;

trait ArcTypeMetadataTrait
{
    use TokenChoicesFilterTrait;

    /**
     * @var array $implementedArcTypes
     */
    private $implementedArcTypes;

    /**
     * @return array Zero or more arcTypes implemented
     */
    public function getImplementedArcTypes() : array
    {
        $implementedArcTypes = $this->implementedArcTypes;
        if (null === $implementedArcTypes) {
            $interfaces = class_implements($this);
            $implementedArcTypes = array_values(array_filter(
                $interfaces,
                function ($interface) {
                    $rclass = new \ReflectionClass($interface);
                    return $rclass->isSubclassOf(ArcTypeInterface::class);
                },
                false
            ));

            $this->$implementedArcTypes = $implementedArcTypes;
        }

        return $implementedArcTypes;
    }

    /**
     * @param string $arcTypeFilter filter to resolve $implementedArcTypes arcTypes
     * @return bool True if ALL resolved arcTypes are $implementedArcTypes.
     */
    public function hasArcTypes(string $arcTypeFilter) : bool
    {
        $tokenChoices = $this->resolveTokenChoices($arcTypeFilter, $this->getImplementedArcTypes());
        return !empty($tokenChoices);
    }
}
