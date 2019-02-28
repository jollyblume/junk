<?php

namespace Jollyblume\Bundle\GraphBunde\Model;

use Jollyblume\Bundle\GraphBundle\Model\PathSegmentInterface;

interface PathSegmentTransformerInterface
{
    /**
     * @param PathSegmentInterface $pathSegment
     * @return bool True if transformer wants to process the pathSegment
     */
    public function wantsPathSegment(PathSegmentInterface &$pathSegment) : bool;

    /**
     * @param PathSegmentInterface $pathSegment
     * @return bool True halt further transformations
     */
    public function transformPathSegment(PathSegmentInterface &$pathSegment) : bool;
}
