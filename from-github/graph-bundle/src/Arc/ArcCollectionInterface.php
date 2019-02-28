<?php

namespace Jollyblume\Bundle\GraphBundle\Arc;

use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainInterface;
use Jollyblume\Bundle\GraphBundle\Arc\ArcInterface;
use Jollyblume\Bundle\GraphBundle\Arc\ArcCollectionInterface;

/**
 * ArcCollectionInterface
 *
 * Sementic target collection
 */
interface ArcCollectionInterface extends TargetCollectionInterface, ValidityChainInterface
{
    /**
     * @param ArcInterface|string $arcOrName
     * @return bool
     */
    public function hasArc($arcOrName);

    /**
     * @return array
     */
    public function getArcs() : array;

    /**
     * @param string $arcName
     * @return ArcInterface|NULL
     */
    public function getArc($arcName) : ?ArcInterface;

    /**
     * @param array $arcs
     * @return self
     */
    public function setArcs(array $arcs) : ArcCollectionInterface;

    /**
     * @param ArcInterface $arc
     * @return self
     */
    public function addArc(ArcInterface $arc) : ArcCollectionInterface;

    /**
     * @param ArcInterface|string $arcOrName
     * @param string $arcName
     * @return ArcInterface|NULL arc removed or NULL if not found
     */
    public function removeArc($arcOrName) : ?ArcInterface;
}
