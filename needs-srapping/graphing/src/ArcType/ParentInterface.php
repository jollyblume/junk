<?php

namespace Jollyblume\Component\Graphing\ArcType;

use Jollyblume\Component\Graphing\ArcType\ArcTypeInterface;
use Jollyblume\Component\Graphing\Node\NodeInterface;

interface ParentInterface extends ArcTypeInterface
{
    /**
     * @return NodeInterface
     */
    public function getParentNode() : ?NodeInterface;

    /**
     * @param NodeInterface $parentNode
     * @return self
     */
    public function setParentNode(NodeInterface $parentNode) : ParentInterface;
}
