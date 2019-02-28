<?php

namespace Jollyblume\Bundle\GraphBundle\Validation;

use Jollyblume\Bundle\GraphBundle\Validation\ErrorsInterface;
use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionInterface;

interface ValidityChainInterface extends ErrorsInterface, TargetCollectionInterface
{
    /**
     * @return bool
     */
    public function isChainValid() : bool;
}
