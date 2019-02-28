<?php

namespace App\Document\Traits;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\ReferencableNodeTrait;

trait PhpcrReferencableNodeTrait {
    use ReferencableNodeTrait;

    /**
     * Phpcr Uuid.
     *
     * @var string
     * @PHPCR\Uuid()
     */
    private $uuid;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getUuidFromStore()
    {
        return $this->uuid;
    }
}
