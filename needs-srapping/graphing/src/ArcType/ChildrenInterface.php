<?php

namespace Jollyblume\Component\Graphing\ArcType;

use Jollyblume\Component\Graphing\ArcType\ArcTypeInterface;
use Jollyblume\Component\Graphing\ArcType\ChildrenDefinition;
use Doctrine\Common\Collections\ArrayCollection;

interface ChildrenInterface extends ArcTypeInterface
{
    const DEFINITION_CLASS = ChildrenDefinition::class;

    /**
     * @return ArrayCollection
     */
    public function getChildNodes() : ArrayCollection;
}
