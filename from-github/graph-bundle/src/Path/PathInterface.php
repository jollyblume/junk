<?php

namespace Jollyblume\Bundle\GraphBundle\Path;

use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionTrait;

interface PathInterface extends TargetCollectionInterface
{
    /**
     * @return string
     */
    public function getPathName() : string;
}
