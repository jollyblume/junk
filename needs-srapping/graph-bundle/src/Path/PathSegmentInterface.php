<?php

namespace Jollyblume\Bundle\GraphBundle\Path;

use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;
use Jollyblume\Bundle\GraphBundle\Path\PathCollection;
use Jollyblume\Bundle\GraphBundle\Path\PathCollectionInterface;
use PharIo\Manifest\AuthorCollection;

interface PathSegmentInterface extends CollectableTargetInterface, PathCollectionInterface
{
    /**
     * @return PathCollection PathCollection containing segment
     */
    public function getSegmentPathCollection() : PathCollection;

    /**
     * @return int Segment's index in getPathCollection();
     */
    public function getSegmentIndex() : int;

    /**
     * @return string Segment's pathFilter
     */
    public function getSegmentName() : string;

    /**
     * @return
     */
    public function hasPath($targetOrKey)
}
