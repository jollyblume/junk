<?php

namespace Jollyblume\Bundle\GraphBundle\Path;

use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;
use Jollyblume\Bundle\GraphBundle\Path\PathInterface;
use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;
use Jollyblume\Bundle\GraphBundle\Collection\PathTargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainInterface;

interface PathSegmentInterface extends TargetCollectionInterface, CollectableTargetInterface, ValidityChainInterface
{
    /**
    * @return PathInterface The original parentPath
    */
    public function getParentPath() : PathInterface;

    /**
     * @return int Original pathSegment index from the parentPath
     */
    public function getSegmentIndex() : int;

    /**
    * @return string Original pathSegment filter from the parentPath
    */
    public function getSegmentFilter() : string;

    /**
     * @return PathTargetCollectionInterface Internal transformation results
     */
    public function getSegmentPaths() : PathTargetCollectionInterface;

    /**
     * @return NodeInterface|NULL Previous pathSegment's sinkNode or NULL if unknown
     */
    public function getSegmentSourceNode() : ?NodeInterface;

    /**
     * @return NodeInterface|NULL Next pathSegment's sourceNode or NULL if unknown
     */
    public function getSegmentSinkNode() : ?NodeInterface;
}
