<?php

namespace Jollyblume\Bundle\GraphBundle\Arc;

use Jollyblume\Bundle\GraphBundle\Arc\ArcInterface;
use Jollyblume\Bundle\GraphBundle\Arc\ArcCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionTrait;
use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainTrait;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsTrait;

class ArcCollection implements ArcCollectionInterface
{
    use TargetCollectionTrait, ValidityChainTrait, ErrorsTrait;

    /**
    * @param ArcInterface|string $arcOrName
     * @return bool
     */
    public function hasArc($arcOrName)
    {
        return $this->hasCollectableTarget($arcOrName);
    }

    /**
     * @return array
     */
    public function getArcs() : array
    {
        return $this->getCollectableTargets();
    }

    /**
     * @param string $arcName
     * @return ArcInterface|NULL
     */
    public function getArc($arcName) : ?ArcInterface
    {
        return $this->getCollectableTarget($arcName);
    }

    /**
     * @param array $arcs
     * @return self
     */
    public function setArcs(array $arcs) : ArcCollectionInterface
    {
        $this->setCollectableTargets($arcs);
        return $this;
    }

    /**
     * @param ArcInterface $arc
     * @return self
     */
    public function addArc(ArcInterface $arc) : ArcCollectionInterface
    {
        $this->addCollectableTarget($arc);
        return $this;
    }

    /**
    * @param ArcInterface|string $arcOrName
     * @return ArcInterface|NULL arc removed or NULL if not found
     */
    public function removeArc($arcOrName) : ?ArcInterface
    {
        return $this->removeCollectableTarget($arcOrName);
    }
}
