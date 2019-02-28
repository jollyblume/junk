<?php

namespace OldApp\Document\Traits;

trait TrashTrait
{
    /**
     * Check if this Bag is used for trash.
     *
     * If true, this Bag is used to store Document Nodes that have been deleted.
     */
    public function isBagTrash()
    {
        return true;
    }
}
