<?php

namespace App\Model;

interface ReferenceableNodeInterface extends NodeInterface
{
    /**
     * Get the Phpcr Uuid.
     *
     * @return string The Phpcr Uuid
     */
    public function getUuid();
}
