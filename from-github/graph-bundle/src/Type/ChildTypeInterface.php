<?php

namespace Jollyblume\Bundle\GraphBundle\Type;

use Jollyblume\Bundle\GraphBundle\Type\ArcTypeInterface;
use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;
use Jollyblume\Bundle\GraphBundle\Collection\NodeTargetCollectionInterface;

interface ChildTypeInterface extends ArcTypeInterface
{
    /**
     * @param string $childNodeFilter filter must resolve to a singlechildNode
     * @return NodeInterface|NULL A singlechildNode or NULL if not found
     */
    public function getChildNode(string $childNodeFilter) : ?NodeInterface;

    /**
     * @param string $childNodeFilter filter must resolve to a singlechildNode
     * @return NodeTargetCollectionInterface Zero or morechildNodes
     */
    public function getChildNodes(string $childNodeFilter) : NodeTargetCollectionInterface;
}
