<?php

namespace Jollyblume\Bundle\GraphBundle\Collection;

use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;

/**
 * TargetCollectionInterface
 *
 * TargetCollectionInterface marks a class as suitable for CollectableTargetInterface
 */
interface TargetCollectionInterface extends \Countable, \ArrayAccess, \IteratorAggregate
{
    /**
    * @param CollectableTargetInterface|string|int $targetOrKey
     * @return bool
     */
    public function hasCollectableTarget($targetOrKey) : bool;

    /**
     * @return array collectableTargets
     */
    public function getCollectableTargets() : array;

    /**
     * @param string|int $targetKey
     * @return CollectableTargetInterface|NULL collectableTarget or NULL if not found
     */
    public function getCollectableTarget($targetKey) : ?CollectableTargetInterface;

    /**
     * @param array $collectableTargets
     * @return self
     */
    public function setCollectableTargets(array $collectableTargets) : TargetCollectionInterface;

    /**
     * @param CollectableTargetInterface $collectableTarget
     * @return self
     */
    public function addCollectableTarget(CollectableTargetInterface $collectableTarget) : TargetCollectionInterface;

    /**
     * @param CollectableTargetInterface|string|int $targetOrKey
     * @return self
     */
    public function removeCollectableTarget($targetOrKey) : ?CollectableTargetInterface;
}
