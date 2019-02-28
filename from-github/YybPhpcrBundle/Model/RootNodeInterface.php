<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Model;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    BranchNodeInterface
};

/**
 * RootNodeInterface
 *
 * Implementations of RootNodeInterface represent ground level for a tree of nodes.
 *
 * The documents and nodes below ground level are not accessable and are only
 * referenced by path. This path is the tree's namespace.
 *
 * Root nodes are created by a phpcr initailizer
 */
interface RootNodeInterface extends BranchNodeInterface
{
    /**
     * Set the parent node
     *
     * Setting the parent node creates an arc node in the parent.
     *
     * @param BranchNodeInterface $parent The parent node to set
     * @return self
     */
    public function setParentNode(BranchNodeInterface $parent);
}
