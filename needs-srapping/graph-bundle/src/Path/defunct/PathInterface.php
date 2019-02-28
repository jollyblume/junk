<?php

namespace Jollyblume\Bundle\GraphBundle\Path;

use Jollyblume\Bundle\GraphBundle\Model\PathInterface;
use Jollyblume\Bundle\GraphBundle\Model\PathSegmentTransformerInterface;
use Jollyblume\Bundle\GraphBundle\Model\PathSegmentInterface;

interface PathInterface extends \Countable, \ArrayAccess, \IteratorAggregate
{
    /**
     * @param int $pathSegmentIndex The pathSegmentIndex
     * @return PathSegmentInterface The pathSegment at the given index
     * @throws \OutOfBoundsException
     */
    public function getPathSegment(int $pathSegmentIndex) : PathSegmentInterface;

    /**
     * @return array The pathSegments
     */
    public function getPathSegments() : array;

    /**
     * @param PathSegmentInterface $pathSegment
     * @return PathInterface self
     */
    public function addPathSegment(PathSegmentInterface $pathSegment) : PathInterface;

    /**
     * @param array The pathSegments
     * @return PathInterface self
     */
    public function setPathSegments(array $pathSegments) : PathInterface;

    /**
     * @param array $transformers Order sensitive array of segmentTransformers
     * @return PathInterface self
     */
    public function setPathSegmentTransformers(array $transformers) : PathInterface;

    /**
     * @param PathSegmentTransformerInterface $transformer A pathSegment transformer
     * @return PathInterface self
     */
    public function addPathSegmentTransformer(PathSegmentTransformerInterface $transformer) : PathInterface;

    /**
     * @return array Order sensitive array of segmentTransformers
     */
    public function getPathSegmentTransformers() : array;

    /**
    * @param int|string $pathSegment Highest pathSegment to transform
    * @return PathSegmentInterface The transformed pathSegment.
    */
    public function transformNextPathSegment() : PathSegmentInterface;
}
