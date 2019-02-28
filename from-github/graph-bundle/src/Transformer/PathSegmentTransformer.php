<?php

namespace Jollyblume\Bundle\GraphBundle\Transformer;

use Jollyblume\Bundle\GraphBundle\Model\PathSegmentTransformerInterface;
use Jollyblume\Bundle\GraphBundle\Model\PathSegmentInterface;

class ParentPathSegmentTransformer implements PathSegmentTransformerInterface
{
    /**
     * @param PathSegmentInterface $pathSegment
     * @return bool True if transformer wants to process the pathSegment
     */
    public function wantsPathSegment(PathSegmentInterface $pathSegment) : bool
    {
        return '..' === $pathSegment->getSegmentFilter();
    }

    /**
     * @param PathSegmentInterface $pathSegment
     * @return bool True halt further transformations
     */
    public function transformPathSegment(PathSegmentInterface &$pathSegment) : bool
    {
        if (!$this->wantsPathSegment($pathSegment)) {
            // Transformer unable to process this pathSegment
            return false;
        }

        $pathSegmentIndex = $pathSegment->getPathSegmentIndex() - 1;
        $prevPathSegment = $pathSegment->getParentPath()->getPathSegment($pathSegmentIndex);
    }
}
