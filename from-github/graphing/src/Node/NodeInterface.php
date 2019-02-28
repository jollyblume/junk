<?php

namespace Jollyblume\Component\Graphing\Node;

use Jollyblume\Component\Graphing\ArcType\MetadataInterface;
use Jollyblume\Component\Graphing\Resolver\FilterResolverInterface;

/**
 * Node
 *
 * A Node represents a node or vertex in a graph.
 *
 * TODO implement CollectionInterface for Arcs
 */
interface NodeInterface extends MetadataInterface, FilterResolverInterface
{
    /**
     * Get a Nodes name
     *
     * @return string
     */
    public function getNodename() : string;
}
