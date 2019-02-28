<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    NodeInterface,
    BranchNodeInterface
};
use YoYogaBear\Bundle\PhpcrBundle\Traits\
{
    NodeInterfaceCommonTrait
};

/**
 * NodeInterfaceTrait
 *
 * Injects extra properties and methods to implement the NodeInterface
 */
trait NodeInterfaceTrait
{
    use NodeInterfaceCommonTrait;

    /**
     * Perform trait construction
     *
     * This method must be called from classes using NodeInterfaceTrait.
     *
     * @param BranchNodeInterface $parentNode The parent node
     * @param string $nodename The node name
     */
    protected function nodeConstruct(BranchNodeInterface $parentDocument, string $nodename)
    {
        // Add this node to it's parent node's child collection.
        $parentDocument->getChildren()->set($nodename, $this);

        // Set private properties
        $this->nodename = $nodename;
        $this->parentDocument = $parentDocument;
    }

    public function getParentDocument(): NodeInterface
    {
        return $this->parentDocument;
    }

    public function getParentNode(): ?NodeInterface
    {
        return $this->getParentDocument();
    }
}
