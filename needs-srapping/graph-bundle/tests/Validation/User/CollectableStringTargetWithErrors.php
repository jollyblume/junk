<?php

namespace Tests\Validation\User;

use Tests\Collection\User\CollectableStringTarget;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsInterface;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsTrait;

class CollectableStringTargetWithErrors extends CollectableStringTarget implements ErrorsInterface
{
    use ErrorsTrait;
}
