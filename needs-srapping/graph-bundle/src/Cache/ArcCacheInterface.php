<?php

namespace Jollyblume\Bundle\GraphBundle\Cache;

use Jollyblume\Bundle\GraphBundle\Arc\ArcInterface;
use Jollyblume\Bundle\GraphBundle\Arc\ArcCollectionInterface;

interface ArcCacheInterface
{
    /**
     * @return string SinkCacheInterface::class or SourceCacheInterface::class
     */
    public function getCacheType() : string;

    /**
     * @param string $arcFilter filter that resolves to a single arcName
     * @return ArcInterface|NULL A single Arc or NULL
     */
    public function getArc(string $arcFilter) : ?ArcInterface;

    /**
     * @param string $arcFilter filter that resolves to zero or more arcNames
     * @return ArcTargetCollectionInterface Zero of more Arcs
     */
    public function getArcs(string $arcFilter) : ArcCollectionInterface;
}
