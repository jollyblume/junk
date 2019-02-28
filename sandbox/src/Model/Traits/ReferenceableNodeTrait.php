<?php

namespace App\Model\Traits;

trait ReferenceableNodeTrait
{
    /**
     * Phpcr Uuid.
     *
     * @var string
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

    /**
     * Get the Phpcr Uuid.
     *
     * @return string The Phpcr Uuid
     */
    public function getUuid()
    {
        return $this->getUuidFromStore();
    }
}
