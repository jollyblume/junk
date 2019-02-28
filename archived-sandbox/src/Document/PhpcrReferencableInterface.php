<?php

namespace App\Document;

/**
 * PhpcrReferencableInterface.
 *
 * Defines a Referencable Phpcr Node
 */
interface PhpcrReferencableInterface extends PhpcrNodeInterface
{
    /**
     * Get the Phpcr Uuid.
     *
     * @return string The Phpcr Uuid
     */
    public function getUuid();
}
