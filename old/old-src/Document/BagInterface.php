<?php

namespace OldApp\Document;

use App\NodeTypeInterface;
use App\Document\CookieStoreInterface;

/**
 * BagInterface.
 *
 * Defines a homogenous collection containing a single type of Document Node
 * class.
 *
 * Bag Nodes extend several collection interfaces:
 *   - Doctrine\Common\Collections\Collection
 *   - Doctrine\Common\Collections\Selectable
 *   - Countable
 *   - IteratorAggregate
 *   - ArrayAccess
 *
 * There should be a one-to-one relation between Bag Nodes and Document Nodes.
 */
interface BagInterface extends PhpcrChildrenInterface, PhpcrReferencableInterface, NodeTypeInterface, CookieStoreInterface
{
    /**
     * Check if this Bag is used for trash.
     *
     * If true, this Bag is used to store Document Nodes that have been deleted.
     */
    public function isBagTrash();

    /**
     * Tests a Node to ensure the Node is supported by the Bag.
     *
     * @return bool True if supported, False if not
     */
    public function supports($node);
}
