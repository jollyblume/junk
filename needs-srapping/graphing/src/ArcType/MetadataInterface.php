<?php

namespace Jollyblume\Component\Graphing\ArcType;

use Jollyblume\Component\Graphing\ArcType\Definition;
use Jollyblume\Component\Graphing\Resolver\FilterResolverInterface;

/**
 * MetadataInterface
 *
 * Methods allowing a Node to interface with ArcTypeInterface.
 *
 * ArcTypeInterface virtuallizes sinkNode accessors and allows the connections
 * to sinkNodes to be wrapped in an object (an Arc).
 *
 * All NodeInterface implementations are sinkNodes, as a connection can be made
 * to any Node. A sourceNode is a Node that supports one or more arcTypes.
 *
 * Interfaces extending ArcTypeInterface represent a single, atomic connection
 * to one or more sinkNodes.
 *
 * Common arcTypes are:
 *      parentArc:      ParentInterface
 *      childrenArc:    ChildrenInterface
 *      childArc:       ChildInterface
 *      referencesArc:  ReferencesInterface
 *      referenceArc:   ReferenceInterface
 *      virtualArc:     VirtualInterface
 *
 * ArcTypeInterface promotes aggregating individual sinkNode connections into
 * a single pool to ease development of node visitors and graph crawlers.
 *
 * It also promotes reorganing a graph's key data info different views based on
 * a new graph hierarchy using a graph crawler and virtualArcs to build the new
 * view and to perform other transformations.
 */
interface MetadataInterface
{
    /**
     * Get the implemented and discovered arcType definitions from cache.
     *
     * Imbues a NodeInterface with connection awareness.
     *
     * Implementations of MetadataInterface must maintain a cache of the arcType
     * interfaces that are known to be supported, including those implemented
     * on the sinkNode or sourceNode class and any discovered to have appropriate
     * methods.
     *
     * When the internal cache is initialized, it will contain only those arcType
     * interfaces implemented on the class.
     *
     * arcType interfaces that are supported, but not implemented, are added via
     * hadDefinitions().
     *
     * @return array [<arcType|arcAlias> => <definition>, ...]
     */
    public function getDefinitions() : array;

    /**
     * Test if a Node is a sourceNode.
     *
     * A Node is a sourceNode if it supports one or more arcTypes.
     *
     * hasDefinitions('') returns TRUE when ANY arcTypes are defined and will
     * return the same result as isSourceNode().
     *
     * Because hasDefinitions() can modify the internal cache, isSourceNode()
     * results should be considered invalid from before calling hasDefinitions().
     *
     * @return bool
     */
    public function isSourceNode();

    /**
     * Test if a Node supports a list of arcTypes.
     *
     * Only returns TRUE if ALL arcType interfaces in the filter are supported
     * after discovery completes.
     *
     * Adds any supported arcTypes discovered to the internal cache.
     *
     * An arcType interface is supported by a sourceNode under 2 conditions:
     *      It is implemented
     *          The arcType interface is implemented in the sourceNode class.
     *      It is supported by concrete methods
     *          The arcType interface can be supported via methods in an alienNode
     *
     * Since hasDefinitions() can modify the internal cache, results from
     * getDefinitions() and isSourceNode() should be considered invalid after
     * calling this method.
     *
     * Adding discovered arcType interfaces is a side-effect. They will be added
     * to the internal cache, regardless the return value of hadDefinitions().
     *
     * NOTE Currently, a discovered interface is only supported if the interface
     *      accessors are defined. This is an internal implementation and will
     *      change.
     *
     * TODO Design a smarter test to detect a supported arcType
     *
     * @param string $arcTypeFilter
     * @return bool TRUE if all arcTypes in the arcTypeFilter are implemented
     */
    public function hasDefinitions(string $arcTypeFilter = '') : bool;

    public function supportsArcType(string $arcType) : bool;
}
