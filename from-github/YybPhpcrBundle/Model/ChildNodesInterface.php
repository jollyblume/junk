<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * ChildNodesInterface
 */
interface ChildNodesInterface
{
    /**
     * Get the phpcr children collection
     *
     * @return Collection The phpcr children collection
     */
    public function getChildren(): Collection;

    /**
     * Get the collection of child nodes
     *
     * Only nodes implementing NodeInterface and not implementing HiddenChildInterface
     * are included. All other types are filtered out.
     *
     * Doctrine doesn't support a child collection filtered by type. This creates a typed
     * children collection.
     *
     * WARNING:
     *      Adding children to this collection will NOT add the child to the tree
     *      Only use the getChildren() collection to add children
     *
     * @param \Closure $predicate Node filter
     * @return Collection The collection of child nodes
     */
    public function getChildNodes(\Closure $predicate = null): Collection;


    /**
     * Get the collection of hidden child nodes
     *
     * Only nodes implementing NodeInterfaceand and HiddenChildInterface are included.
     * All other types are filtered out.
     *
     * Doctrine doesn't support a child collection filtered by type. This creates a typed
     * children collection.
     *
     * WARNING:
     *      Adding children to this collection will NOT add the child to the tree
     *      Only use the getChildren() collection to add children
     *
     * @param \Closure $predicate Node filter
     * @return Collection The collection of child nodes
     */
    public function getHiddenNodes(): Collection;
}
