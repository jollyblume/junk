<?php

namespace App\Traits;

trait ReferencableNodeTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    abstract protected function getUuidFromStore();

    /**
     * Get the Phpcr Uuid.
     *
     * @return string The Phpcr Uuid
     */
    public function getUuid() {
        return $this->getUuidFromStore();
    }
}
