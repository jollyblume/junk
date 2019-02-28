<?php

namespace App\Model;
use App\Model\NodeInterface;

interface ReferencableNodeInterface extends NodeInterface {
    /**
     * Get the Phpcr Uuid.
     *
     * @return string The Phpcr Uuid
     */
    public function getUuid();
}
