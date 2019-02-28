<?php

namespace App\Document;

use Doctrine\Common\Collections\Collection;
use App\Collections\ComposedCollectionInterface;

/**
 * PhpcrChildrenInterface.
 *
 * Defines Phpcr Child support
 */
interface PhpcrChildrenInterface extends PhpcrNodeInterface, ComposedCollectionInterface
{
    /**
     * Get the Phpcr Children collection.
     *
     * @return Collection The Phpce Children collection
     */
    public function getChildren();
}
