<?php

namespace Jollyblume\Component\Graphing\ArcType;

use InvalidArgumentException;
use Jollyblume\Component\Graphing\ArcType\ArcTypeInterface;
use Jollyblume\Component\Graphing\ArcType\MetadataInterface;

/**
 * Definition
 */
class Definition
{
    /**
     * @var string $arcType
     */
    private $arcType;

    /**
     * @var MetadataInterface $sourceNode
     */
    private $sourceNode;

    /**
     * @var bool $isAlienArcType
     */
    private $isAlienArcType;

    /**
     * Constructor
     *
     * @param string $arcType
     * @param MetadataInterface $sourceNode
     * @return void
     */
    public function __construct(string $arcType, MetadataInterface $sourceNode)
    {
        $this->arcType = $arcType;
        if (!interface_exists($arcType)) {
            throw new InvalidArgumentException(sprintf(
                'NO_SUCH_INTERFACE: interface "%s" not found',
                $arcType
            ));
        }
        if (ArcTypeInterface::class === $arcType) {
            throw new InvalidArgumentException(
                'INVALID_ARCTYPE: ArcTypeInterface is not an arcType'
            );
        }
        $arcTypeImplements = class_implements($arcType);
        if (!in_array(ArcTypeInterface::class, $arcTypeImplements)) {
            throw new InvalidArgumentException(sprintf(
                'NOT_AN_ARCTYPE: "%s" must extend ArcTypeInterface',
                $arcType
            ));
        }
        if (!$sourceNode->supportsArcType($arcType)) {
            throw new InvalidArgumentException(
                'UNSUPPORTED_ARCTYPE'
            );
        }
        $this->arcType = $arcType;
        $this->sourceNode = $sourceNode;
        $this->isAlienArcType = !$sourceNode instanceof $arcType;
    }

    /**
     * Get the arcType
     *
     * @return string
     */
    public function getArcType() : string
    {
        return $this->arcType;
    }

    /**
     * Get the sourceNode
     *
     * @return MetadataInterface
     */
    public function getSourceNode() : MetadataInterface
    {
        return $this->sourceNode;
    }

    /**
     * Test if arcType is implemented by Node or not
     */
    public function isAlienArcType() : bool
    {
        return true === $this->isAlienArcType;
    }
}
