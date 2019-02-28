<?php

namespace Jollyblume\Bundle\GraphBundle\Type;

use Jollyblume\Bundle\GraphBundle\Type\ArcTypeInterface;
use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;
use Jollyblume\Bundle\GraphBundle\Node\NodeTargetCollectionInterface;

interface LinkTypeInterface extends ArcTypeInterface
{
    /**
     * @param string $linkNodeFilter filter must resolve to a single linkNode
     * @return NodeInterface|NULL A single linkNode or NULL if not found
     */
    public function getLinkNode(string $linkNodeFilter) : ?NodeInterface;

    /**
     * @param string $linkNodeFilter filter must resolve to a single linkNode
     * @return NodeTargetCollectionInterface Zero or more linkNodes
     */
    public function getLinkNodes(string $linkNodeFilter) : NodeTargetCollectionInterface;
}
