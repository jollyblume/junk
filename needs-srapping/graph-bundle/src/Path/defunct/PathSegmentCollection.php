<?php

namespace Jollyblume\Bundle\GraphBundle\Collection;

use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetsCollectionTrait;
use Jollyblume\Bundle\GraphBundle\Collection\PathSegmentTargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Path\PathSegmentInterface;

class PathSegmentCollection implements PathSegmentTargetCollectionInterface
{
    use CollectableTargetsCollectionTrait;

    /**
     * @param int $pathSegmentIndex
     * @return bool True if $pathSegmentIndex exists
     */
    public function hasPathSegmentIndex(int $pathSegmentIndex) : bool
    {
        /** todo: pathSegments as indexes would be large strings. how does that scale? */
        return array_key_exists($pathSegmentName, $this->getPathSegments());
    }

    /**
     * @return array [<pathSegmentName> => <pathSegment>], ...
     */
    public function getPathSegments() : array
    {
        return $this->getCollectableTargets();
    }

    /**
     * @param string $pathSegmentName
     * @return PathSegmentInterface PathSegment for pathSegmentName
     */
    public function getPathSegment(string $pathSegmentName) : ?PathSegmentInterface
    {
        return $this->getPathSegments()[$pathSegmentName];
    }

    /**
     * @return PathSegmentTargetCollectionInterface self
     */
    public function setPathSegments(array $pathSegments) : PathSegmentTargetCollectionInterface
    {
        foreach ($pathSegments) {
            $this->addPathSegment($pathSegment);
        }

        return $this;
    }

    /**
     * @param PathSegmentInterface $pathSegment The PathSegment to add
     * @return PathSegmentTargetCollectionInterface self
     */
    public function addPathSegment(PathSegmentInterface $pathSegment) : PathSegmentTargetCollectionInterface
    {
        $this->addCollectable($pathSegment);

        return $this;
    }

    /**
     * @param string $pathSegmentName
     * @return PathSegmentInterface The PathSegment removed or NULL
     */
    public function removePathSegment(string $pathSegmentName) : ?PathSegmentInterface
    {
        $pathSegments = $this->getPathSegments();
        if (array_key_exists($pathSegmentName, $pathSegments) {
            $removedPathSegment = $pathSegments[$pathSegmentName];
            unset($pathSegments[$pathSegmentName]);
            $this->collectableTargets = $pathSegments;
            return $removedPathSegment;
        }

        return null;
    }

    /**
     * Countable::count()
     *
     * @return Number of PathSegments
     */
    public function count() : int
    {
        return count($this->getPathSegments());
    }

    /**
     * ArrayAccess::offsetExists()
     *
     * @param string $pathSegmentName PathSegment key
     * @return bool
     */
    public function offsetExists($pathSegmentName)
    {
        return $this->hasPathSegmentName($pathSegmentName);
    }

    /**
     * ArrayAccess::offsetGet()
     *
     * @param string $pathSegmentName PathSegment key
     * @return PathSegmentInterface
     */
    public function offsetGet($pathSegmentName)
    {
        return $this->getPathSegment($pathSegmentName);
    }

    /**
     * ArrayAccess::offsetSet()
     *
     * @param string $pathSegmentName PathSegment key
     * @param PathSegmentInterface $pathSegment
     * @return PathSegmentInterface
     * @throw InvalidArgumentException if $pathSegmentName !== strval($pathSegment)
     */
    public function offsetSet($pathSegmentName, $pathSegment)
    {
        if ($pathSegmentName !== strval($pathSegment)) {
            throw new \InvalidArgumentException('fix this error message');
        }

        $this->addPathSegment($pathSegment);
    }

    /**
     * ArrayAccess::offsetUnset()
     *
     * @param string $pathSegmentName PathSegment key
     * @return PathSegmentInterface
     */
    public function offsetUnset($pathSegmentName)
    {
        $this->removePathSegment($pathSegmentName);

        /** todo: should i throw OutOfBoundsException here? */
    }

    /**
     * IteratorAggregate::getIterator()
     *
     * @return \Traversable
     */
    public function getIterator() : \Traversable
    {
        return new \ArrayIterator($this->getPathSegments());
    }
}
