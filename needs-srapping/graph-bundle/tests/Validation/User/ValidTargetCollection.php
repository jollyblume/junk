<?php

namespace Tests\Validation\User;

use Jollyblume\Bundle\GraphBundle\Validation\ErrorsTrait;
use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainTrait;
use Tests\Collection\User\TargetCollection;
use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainInterface;

class ValidTargetCollection extends TargetCollection implements ValidityChainInterface
{
    use ValidityChainTrait, ErrorsTrait;
}
