<?php

namespace App\Document\Traits;

/**
 * PhpcrReferencableTrait.
 *
 * Implements PhpcrReferencableInterface
 */
trait PhpcrReferencableTrait
{
    /**
     * Phpcr Uuid.
     *
     * @var string
     */
    private $uuid;

    /**
     * Get the Phpcr Uuid.
     *
     * @return string The Phpcr Uuid
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
