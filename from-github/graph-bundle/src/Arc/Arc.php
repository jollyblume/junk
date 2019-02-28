<?php

namespace Jollyblume\Bundle\GraphBundle\Arc;

use Jollyblume\Bundle\GraphBundle\Arc\ArcInterface;
use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;
use Jollyblume\Bundle\GraphBundle\Node\SourceNodeInterface;
use Jollyblume\Bundle\GraphBundle\Node\SinkNodeInterface;
use Jollyblume\Bundle\GraphBundle\Type\ArcTypeInterface;
use Jollyblume\Bundle\GraphBundle\Exception\NodeException;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsTrait;

class Arc implements ArcInterface
{
    use ErrorsTrait;

    /**
     * @var NodeInterface $sourceNode
     */
    private $sourceNode;

    /**
     * @var NodeInterface $sinkNode
     */
    private $sinkNode;

    /**
     * @var string $arcType
     */
    private $arcType;

    /**
     * @param NodeInterface $sourceNode
     * @param NodeInterface $sinkNode
     * @param string $arcType
     * @throws NodeException
     */
    public function __construct(NodeInterface $sourceNode, NodeInterface $sinkNode, string $arcType)
    {
        if (!$sourceNode instanceof SourceNodeInterface) {
            throw new NodeException('fix this error message. must implement SourceNodeInterface');
        }

        if (!$sinkNode instanceof SinkNodeInterface) {
            throw new NodeException('fix this error message. must implement SinkNodeInterface');
        }

        // if (!$arcType instanceof ArcTypeInterface) {
        //     throw new NodeException('fix this error message. must implement ArcTypeInterface');
        // }

        $this->sourceNode = $sourceNode;
        $this->sinkNode = $sinkNode;
        $this->arcType = $arcType;
    }

    /**
     * @return NodeInterface The sourceNode
     */
    public function getSourceNode() : NodeInterface
    {
        return $this->sourceNode;
    }

    /**
     * @return NodeInterface The sinkNode or NULL if invalid
     */
    public function getSinkNode() : ?NodeInterface
    {
        return $this->sinkNode;
    }

    /**
     * @return string The arcType
     */
    public function getArcType() : string
    {
        return $this->arcType;
    }

    /**
     * @return string arcName (<sourceNode>:<sinkNode>:<arcType>)
     */
    public function getArcName() : string
    {
        return sprintf(
            '%s:%s:%s',
            $this->getSourceNode()->getNodename(),
            null === $this->getSinkNode() ? '' : $this->getSinkNode()->getNodename(),
            $this->getArcType()
        );
    }

    /**
    * CollectableTargetInterface::getCollectableTargetKey()
    *
    * @return string
    */
    public function getCollectableTargetKey()
    {
        return $this->getArcName();
    }

    /**
     * CollectableTargetInterface::__toString()
     */
    public function __toString() : string
    {
        return $this->getArcName();
    }
}
