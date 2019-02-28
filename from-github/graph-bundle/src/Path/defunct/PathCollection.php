<?php

namespace Jollyblume\Bundle\GraphBundle\Collection;

use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetsCollectionTrait;
use Jollyblume\Bundle\GraphBundle\Collection\PathTargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Path\PathInterface;

class PathCollection implements PathTargetCollectionInterface
{
    use CollectableTargetsCollectionTrait;

    /**
     * @param string $pathName
     * @return bool True if $pathName exists
     */
    public function hasPathName(string $pathName) : bool
    {
        /** todo: paths as indexes would be large strings. how does that scale? */
        return array_key_exists($pathName, $this->getPaths());
    }

    /**
     * @return array [<pathName> => <path>], ...
     */
    public function getPaths() : array
    {
        return $this->getCollectableTargets();
    }

    /**
     * @param string $pathName
     * @return PathInterface Path for pathName
     */
    public function getPath(string $pathName) : ?PathInterface
    {
        return $this->getPaths()[$pathName];
    }

    /**
     * @return PathTargetCollectionInterface self
     */
    public function setPaths(array $paths) : PathTargetCollectionInterface
    {
        foreach ($paths) {
            $this->addPath($path);
        }

        return $this;
    }

    /**
     * @param PathInterface $path The Path to add
     * @return PathTargetCollectionInterface self
     */
    public function addPath(PathInterface $path) : PathTargetCollectionInterface
    {
        $this->addCollectable($path);

        return $this;
    }

    /**
     * @param string $pathName
     * @return PathInterface The Path removed or NULL
     */
    public function removePath(string $pathName) : ?PathInterface
    {
        $paths = $this->getPaths();
        if (array_key_exists($pathName, $paths) {
            $removedPath = $paths[$pathName];
            unset($paths[$pathName]);
            $this->collectableTargets = $paths;
            return $removedPath;
        }

        return null;
    }

    /**
     * Countable::count()
     *
     * @return Number of Paths
     */
    public function count() : int
    {
        return count($this->getPaths());
    }

    /**
     * ArrayAccess::offsetExists()
     *
     * @param string $pathName Path key
     * @return bool
     */
    public function offsetExists($pathName)
    {
        return $this->hasPathName($pathName);
    }

    /**
     * ArrayAccess::offsetGet()
     *
     * @param string $pathName Path key
     * @return PathInterface
     */
    public function offsetGet($pathName)
    {
        return $this->getPath($pathName);
    }

    /**
     * ArrayAccess::offsetSet()
     *
     * @param string $pathName Path key
     * @param PathInterface $path
     * @return PathInterface
     * @throw InvalidArgumentException if $pathName !== strval($path)
     */
    public function offsetSet($pathName, $path)
    {
        if ($pathName !== strval($path)) {
            throw new \InvalidArgumentException('fix this error message');
        }

        $this->addPath($path);
    }

    /**
     * ArrayAccess::offsetUnset()
     *
     * @param string $pathName Path key
     * @return PathInterface
     */
    public function offsetUnset($pathName)
    {
        $this->removePath($pathName);

        /** todo: should i throw OutOfBoundsException here? */
    }

    /**
     * IteratorAggregate::getIterator()
     *
     * @return \Traversable
     */
    public function getIterator() : \Traversable
    {
        return new \ArrayIterator($this->getPaths());
    }
}
