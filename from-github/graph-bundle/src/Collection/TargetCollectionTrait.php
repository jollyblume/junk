<?php

namespace Jollyblume\Bundle\GraphBundle\Collection;

use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;

trait TargetCollectionTrait
{
    /**
     * @var array $collectableTargets
     */
    private $collectableTargets;

    /**
    * @param CollectableTargetInterface|string|int $targetOrKey
     * @return bool
     */
    public function hasCollectableTarget($targetOrKey) : bool
    {
        $collectableTargets = $this->getCollectableTargets();

        $targetKey = $targetOrKey instanceof CollectableTargetInterface ? $targetOrKey->getCollectableTargetKey() : $targetOrKey;
        return array_key_exists($targetKey, $collectableTargets);
    }

    /**
     * @return array collectableTargets
     */
    public function getCollectableTargets() : array
    {
        $targets = $this->collectableTargets;
        if (null === $targets) {
            $targets = [];
            $this->collectableTargets = $targets;
        }
        return $targets;
    }

    /**
     * @param string|int $targetKey
     * @return CollectableTargetInterface|NULL collectableTarget or NULL if not found
     */
    public function getCollectableTarget($targetKey) : ?CollectableTargetInterface
    {
        return $this->getCollectableTargets()[$targetKey];
    }

    /**
     * @param array $collectableTargets
     * @return self
     */
    public function setCollectableTargets(array $collectableTargets) : TargetCollectionInterface
    {
        foreach ($collectableTargets as $target) {
            $this->addCollectableTarget($target);
        }

        return $this;
    }

    /**
     * @param CollectableTargetInterface $collectableTarget
     * @return self
     */
    public function addCollectableTarget(CollectableTargetInterface $collectableTarget) : TargetCollectionInterface
    {
        $this->getCollectableTargets();
        $targetKey = $collectableTarget->getCollectableTargetKey();
        $this->collectableTargets[$targetKey] = $collectableTarget;
        return $this;
    }

    /**
     * @param CollectableTargetInterface|string|int $targetOrKey
     * @return self
     */
    public function removeCollectableTarget($targetOrKey) : ?CollectableTargetInterface
    {
        $targets = $this->getCollectableTargets();
        $targetKey = $targetOrKey;
        if ($targetOrKey instanceof CollectableTargetInterface) {
            $targetKey = $targetOrKey->getCollectableTargetKey();
        }
        unset($this->collectableTargets[$targetKey]);
        return isset($targets[$targetKey]) ? $targets[$targetKey] : null;
    }

    /**
     * \Countable::count()
     *
     * @return int
     */
    public function count() : int
    {
        return count($this->getCollectableTargets());
    }

    /**
     * \ArrayAccess::offsetExists()
     *
     * @param string|int $targetKey
     * @return bool
     */
    public function offsetExists($targetKey)
    {
        return $this->hasCollectableTarget($targetKey);
    }

    /**
     * \ArrayAccess::offsetGet()
     *
     * todo: using $targetOrKey doesn't make sense here
     *
     * @param string|int $targetKey
     * @return bool
     */
    public function offsetGet($targetKey)
    {
        return $this->getCollectableTarget($targetKey);
    }

    /**
     * \ArrayAccess::offsetSet()
     *
     * @param string|int $targetKey
     * @param CollectableTargetsCollectionInterface $collectableTarget
     * @SuppressWarnings(unused)
     */
    public function offsetSet($targetKey, $collectableTarget)
    {
        $this->addCollectableTarget($collectableTarget);
    }

    /**
     * \ArrayAccess::offsetUnset()
     *
     * @param CollectableTargetInterface|string|int $targetOrKey
     */
    public function offsetUnset($targetOrKey)
    {
        $this->removeCollectableTarget($targetOrKey);
    }

    /**
     * \IteratorAggregate::getIterator()
     *
     * @return \Traversable
     */
    public function getIterator() : \Traversable
    {
        return new \ArrayIterator($this->getCollectableTargets());
    }
}
