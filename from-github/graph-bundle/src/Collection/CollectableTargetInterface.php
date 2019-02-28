<?php

namespace Jollyblume\Bundle\GraphBundle\Collection;

/**
 * CollectableTargetInterface
 *
 * CollectableTargetInterface marks a class a suitable for use by TargetCollectionInterface
 */
interface CollectableTargetInterface
{
    /**
     * @return string|int Index or key in a TargetCollectionInterface
     */
    public function getCollectableTargetKey();

    /**
     * @return strval(getCollectableTargetKey())
     */
    public function __toString();
}
