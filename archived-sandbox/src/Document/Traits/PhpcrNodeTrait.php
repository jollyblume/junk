<?php

namespace App\Document\Traits;

use App\Document\PhpcrNodeInterface;

/**
 * PhpcrNodeTrait.
 *
 * Implements PhpcrNodeInterface setters.
 */
trait PhpcrNodeTrait
{
    use PrivateNodeTrait;

    /**
     * Set the Phpcr Nodename.
     *
     * @throws PropImmutableException If Nodename or Id all ready set
     *
     * @return self
     */
    public function setNodename(string $nodename)
    {
        return $this->innerSetNodename($nodename);
    }

    /**
     * Set the Phpcr Id.
     *
     * @throws PropImmutableException If any sibling properties are set
     *
     * @return self
     */
    public function setId(string $identifier)
    {
        return $this->innerSetId($identifier);
    }
}
