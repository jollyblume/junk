<?php

namespace Jollyblume\Bundle\GraphBundle\Arc;

use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsInterface;
use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;

interface ArcInterface extends CollectableTargetInterface, ErrorsInterface
{
    /**
     * @return NodeInterface The sourceNode
     */
    public function getSourceNode() : NodeInterface;

    /**
     * @return NodeInterface The sinkNode or NULL if invalid
     */
    public function getSinkNode() : ?NodeInterface;

    /**
     * @return string The arcType
     */
    public function getArcType() : string;

    /**
     * @return string arcName (<sourceNode>:<sinkNode>:<arcType>)
     */
    public function getArcName() : string;
}
