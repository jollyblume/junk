<?php

namespace Jollyblume\Bundle\GraphBundle\Metadata;

interface ArcTypeMetadataInterface
{
    /**
     * @return array Zero or more implemented arcTypes
     */
    public function getImplementedArcTypes() : array;

    /**
     * @param string $arcTypeFilter filter to resolve implemented arcTypes
     * @return bool True if ALL resolved arcTypes in the filter are implemented.
     */
    public function hasArcTypes(string $arcTypeFilter) : bool;
}
