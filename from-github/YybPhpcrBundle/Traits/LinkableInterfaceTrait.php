<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};

/**
 * LinkableInterfaceTrait
 *
 * Injects properties and methods to implement the LinkableInterface
 */
trait LinkableInterfaceTrait
{
    /**
     * @PHPCR\Uuid()
     * @var string $uuid
     */
    private $uuid;

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
