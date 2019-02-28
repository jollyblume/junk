<?php

namespace Jollyblume\Bundle\GraphBundle\Type;

use Jollyblume\Bundle\GraphBundle\Type\ArcTypeInterface;
use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;

interface ParentTypeInterface extends ArcTypeInterface
{
    /**
     * @return NodeInterface|NULL The parentNode or NULL if not found
     */
    public function getParentNode() : ?NodeInterface;
}
